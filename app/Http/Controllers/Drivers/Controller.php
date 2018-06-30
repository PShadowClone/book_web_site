<?php

namespace App\Http\Controllers\Drivers;

use App\Company;
use App\Driver;
use App\User;
use App\UserPayment;
use App\Request as UserRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

class Controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        sessioned_title('driver');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * password encryption using md5 hashing
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules($request), $this->messages());
        try {
            $company = null;
            if ($request->input('single_company') == COMPANY_TYPE) {
                $company = Company::create([
                    'phone' => $request->input('company_phone'),
                    'email' => $request->input('company_url'),
                    'address' => $request->input('company_address'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            $driver = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'single_company' => $request->input('single_company'),
                'type' => DRIVER,
                'instRate' => $request->input('inst_rate'),
                'company_id' => !$company ? null : $company->id,
                'password' => md5($request->input('password')),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()

            ]);
            success_message(trans('driver.stored_successfully'));
            return redirect()->route('driver.edit', ['id' => $driver->id]);
        } catch (\Exception $exception) {
            error_message(trans('driver.stored_error'));
            return redirect()->route('driver.show');
        }
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('Drivers.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $driver = Driver::find($id);
        if (!$driver) {
            error_message(trans('driver.not_found'));
            return redirect()->route('driver.show');
        }
        try {
            $data['driver'] = $driver;
            $data['company'] = $driver->company;
            $data['instPayedProfits'] = UserPayment::userPayments($id);
            $data['instProfits'] = $this->calculateInstitutionProfits($driver->instRate, $driver->total_profits);
            $data['resetPayment'] = $data['instProfits'] - $data['instPayedProfits'];
            $data['pureProfits'] = $driver->total_profits - UserPayment::userPayments($id);
            return view('Drivers.update', $data);
        } catch (\Exception $exception) {
            error_message(trans('driver.edit_error'));
            return redirect()->route('driver.show');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        $driver = User::find($id);
        if (!$driver) {
            error_message(trans('driver.not_found'));
            return redirect()->route('driver.show');
        }
        $this->validate($request, $this->rules($request, $driver->id, $driver->company ? $driver->company->id : -1), $this->messages());
        try {
            if ($request->input('single_company') == COMPANY_TYPE) {
                $driverCompany = $driver->company;
                if ($driverCompany) {
                    $driverCompany->phone = $request->input('company_phone');
                    $driverCompany->email = $request->input('company_email');
                    $driverCompany->address = $request->input('company_address');
                    $driverCompany->update();
                } else {
                    $driverCompany = Company::create([
                        'phone' => $request->input('company_phone'),
                        'email' => $request->input('company_email'),
                        'address' => $request->input('company_address'),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()

                    ]);
                }
                $driver->company_id = $driverCompany->id;

            } else {
                $driverCompany = $driver->company;
                if ($driverCompany) {
                    $driverCompany->delete();

                }
                $driver->company_id = null;
            }
            $driver->name = $request->input('name');
            $driver->email = $request->input('email');
            $driver->phone = $request->input('phone');
            $driver->status = $request->input('status');
            $driver->single_company = $request->input('single_company');
            $driver->instRate = $request->input('instRate');
            if ($request->input('password') && trim($request->input('password')) != '') {
                $driver->password = Hash::make($request->input('password'));
            }
            $driver->updated_at = Carbon::now();
            $driver->update();
            success_message(trans('driver.updated_successfully'));
            return redirect()->route('driver.show');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            error_message(trans('driver.updated_error'));
            return redirect()->route('driver.show')->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int null $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        if (!$request->ajax())
            return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
        try {
            $user = User::find($id);
            if (!$user)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('driver.not_found')]);
            $user->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('driver.deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('driver.deleted_error')]);
        }
    }

    /**
     * show all drivers in system by providing their objects to ajax datatable
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function getAllDrivers(Request $request)
    {
//        var_dump($request->all());
        if (!$request->ajax())
            return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
        try {
            if (!$request->ajax())
                return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
            $driver = Driver::orderBy('created_at', 'desc')->where([]);
            if ($request->input('quarter') && $request->input('quarter') != '-1') {
                $driver = Driver::byQuarter($request->input('quarter'));
            }
            if ($request->input('city') && $request->input('city') != '-1') {
                $driver = Driver::byCity($request->input('city'));
            }
            if ($request->input('area') && $request->input('area') != '-1') {
                $driver = Driver::byArea($request->input('area'));
            }
            if ($request->input('phone')) {
                $driver = $driver->orWhere('phone', 'like', '%' . $request->input('phone') . '%');
            }
            if ($request->input('name')) {
                $driver = $driver->orWhere('name', 'like', '%' . $request->input('name') . '%');
            }
            if ($request->input('email')) {
                $driver = $driver->orWhere('email', 'like', '%' . $request->input('email') . '%');
            }

            if ($request->input('status') && $request->input('status') != '-1') {
                $driver = $driver->where('status', '=', $request->input('status'));
            }
//            var_dump($driver->count());


            $driver = $driver->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('drivers.show_successfully'), 'data' => $driver]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => $exception->getMessage(), 'data' => []]);
//            return response()->json(['status' => SERVER_ERROR, 'message' => trans('drivers.show_error'), 'data' => []]);
        }
    }


    public function getAllRequests(Request $request, $driver_id = null)
    {
        try {
            $userRequests = UserRequest::where('requests.driver_id', '=', $driver_id)->where([]);
            if ($request->input('client')) {
//                dd($request->input('client'));
                $userRequests = UserRequest::byClient($request->input('client'))->where('requests.driver_id', '=', $driver_id);
            }
//            if ($request->input('driver')) {
//                $userRequests = UserRequest::byDriver($request->input('driver'))->where('requests.driver_id', '=', $driver_id);
//            }
            if ($request->input('status') && $request->input('status') != '-1') {
                $userRequests = $userRequests->where('requests.status', '=', $request->input('status'));
            }
            if ($request->input('from')) {
                $userRequests = $userRequests->where('requests.created_at', 'like', '%' . $request->input('from') . '%');
            }
            if ($request->input('to')) {
                $userRequests = $userRequests->where('delivery_time', 'like', '%' . $request->input('to') . '%');
            }
            if ($request->input('request_identifier')) {
                $userRequests = $userRequests->where('requests.request_identifier', 'like', '%' . $request->input('request_identifier') . '%');
            }
            $userRequests = $userRequests->get()->map(function ($item) {
                $item->client;
                $item->driver;
                $item->book;
                return $item;
            });
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('request.show_successfully'), 'data' => $userRequests]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('request.show_error'), 'data' => []]);
//            return response()->json(['status' => SERVER_ERROR, 'message' => $exception->getMessage(), 'data' => []]);
        }
    }


    /**
     * activate or deactivate user according to his/her $id
     * @param Request $request
     * @param null $id
     * @param string $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request, $id = null, $status = ACTIVE)
    {
        if (!$request->ajax())
            return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
        try {
            $user = User::find($id);
            if (!$user)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('driver.not_found')]);
            $user->status = $status;
            $user->updated_at = Carbon::now();
            $user->update();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => $status == ACTIVE ? trans('driver.activated') : trans('driver.deactivated')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('driver.status_changed_error')]);
        }

    }

    private function calculateInstitutionProfits($rate, $total)
    {
        return ($rate * $total) / 100;
    }

    private function rules($request, $id = -1, $company_id = -1)
    {
        $rules = [
            'name' => 'required|String|min:3'

        ];
        if ($request->input('single_company') == '2') {
            if ($company_id != -1) {
                $rules['company_phone'] = ['required', 'numeric', 'digits_between:1,15', 'regex:/^\d+$/', Rule::unique('companies', 'phone')->ignore($company_id, 'id')];
                $rules['company_email'] = ['required', 'email', Rule::unique('companies', 'email')->ignore($company_id, 'id')];
            } else {
                $rules['company_phone'] = 'required|numeric|unique:companies,phone|digits_between:1,15|regex:/^\d+$/';
                $rules['company_email'] = 'required|email|unique:companies,email';
            }
            $rules['company_address'] = 'required';

        }
        if ($id != -1) {
            $rules['email'] = ['required', 'email', Rule::unique('admins', 'email')->ignore($id, 'id')];
            $rules['phone'] = ['required', 'numeric', 'digits_between:1,15', 'regex:/^\d+$/', Rule::unique('users', 'phone')->ignore($id, 'id')];

            if ($request->input('password') && trim($request->input('password')) != '') {
                $rules['password'] = 'sometimes|required|min:6';
                $rules['confirm_password'] = 'same:password';
            }
        } else {
            $rules['phone'] = 'required|numeric|digits_between:1,15|regex:/^\d+$/';
            $rules['email'] = 'required|email';
            $rules['password'] = 'required|min:6';
            $rules['confirm_password'] = 'same:password';
            $rules['inst_rate'] = 'required|numeric|min:1|max:100';
            $rules['status'] = 'required|in:1,2';
        }
        return $rules;

    }


    /**
     *
     * validation messages
     * @return array
     *
     */

    private function messages()
    {
        return [
            'name.required' => trans('driver.name_required'),
            'name.String' => trans('driver.name_string'),
            'name.min' => trans('driver.name_min'),
            'name.regex' => trans('driver.name_string'),
            'phone.required' => trans('driver.phone_required'),
            'phone.numeric' => trans('driver.phone_number'),
            'phone.digits_between' => trans('driver.phone_min'),
            'phone.regex' => trans('driver.phone_number'),
            'phone.unique' => trans('driver.phone_unique'),
//                'mobile.required' => trans('driver.mobile_required'),
//                'mobile.numeric' => trans('driver.mobile_number'),
//                'mobile.digits_between' => trans('driver.mobile_min'),
//                'mobile.regex' => trans('driver.mobile_number'),
            'password.required' => trans('driver.password_required'),
            'password.min' => trans('driver.password_min'),
            'confirm_password.same' => trans('driver.confirm_password_required'),
            'email.required' => trans('driver.email_required'),
            'email.email' => trans('driver.email_email'),
            'quarter.required' => trans('driver.quarter_required'),
            'quarter.exists' => trans('driver.quarter_exists'),
            'inst_profit_rate.required' => trans('driver.inst_profit_rate_required'),
            'inst_profit_rate.numeric' => trans('driver.inst_profit_rate_number'),
            'inst_profit_rate.min' => trans('driver.inst_profit_rate_min'),
            'inst_profit_rate.max' => trans('driver.inst_profit_rate_max'),
            'status.required' => trans('driver.status_required'),
            'status.in' => trans('driver.status_in'),
        ];
    }

}

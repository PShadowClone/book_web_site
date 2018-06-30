<?php

namespace App\Http\Controllers\Library;

use App\City;
use App\Library;
use App\LibraryPayment;
use App\Quarter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use \App\Area;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Request as UserRequest;

class Controller extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        sessioned_title('library');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['areas'] = Area::all();
        $data['cities'] = City::all();
        $data['quarters'] = Quarter::all();
        return view('Library.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * password using md5 encryption
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules($request), $this->messages());
        try {
            $library = Library::create([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'mobile' => $request->input('mobile'),
                'status' => $request->input('status'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'instProfitRate' => $request->input('inst_profit_rate'),
                'longitude' => $request->input('longitude'),
                'latitude' => $request->input('latitude'),
                'quarter_id' => $request->input('quarter'),
                'commercial_record' => $request->input('commercial_record'),
                'password' => md5($request->input('password')),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            success_message(trans('library.stored_successfully'));
            return redirect()->route('library.update', ['id' => $library->id]);
        } catch (\Exception $exception) {
            error_message(trans('library.stored_error'));
        }
        return redirect()->route('library.show');

    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data['areas'] = Area::all();
        $data['cities'] = City::all();
        $data['quarters'] = Quarter::all();
        return view('Library.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $library = Library::find($id);
        if (!$library) {
            error_message(trans('library.library_not_found'));
            return redirect()->route('library.show');
        }
        $data['areas'] = areas();
        $data['cities'] = cities();
        $data['quarters'] = quarters();
        $data['library'] = $library;
        $data['instPayedProfits'] = LibraryPayment::libraryPayments($library->id);
        $data['instProfits'] = $this->calculateInstitutionProfits($library->instProfitRate, $library->total_profits);
        $data['resetPayment'] = $data['instProfits'] - $data['instPayedProfits'];
        $data['pureProfits'] = $library->total_profits - LibraryPayment::libraryPayments($id);

        return view('Library.update', $data);

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
        $this->validate($request, $this->rules($request, $id), $this->messages());
        $library = Library::find($id);
        if (!$library) {
            error_message(trans('library.library_not_found'));
            return redirect()->route('library.show');
        }
        try {
            $library->name = $request->input('name');
            $library->phone = $request->input('phone');
            $library->mobile = $request->input('mobile');
            $library->status = $request->input('status');
            $library->address = $request->input('address');
            $library->email = $request->input('email');
            $library->instProfitRate = $request->input('inst_profit_rate');
            $library->longitude = $request->input('longitude');
            $library->latitude = $request->input('latitude');
            $library->quarter_id = $request->input('quarter');
            $library->commercial_record = $request->input('commercial_record');
            $library->updated_at = Carbon::now();
            if ($request->input('password') && trim($request->input('password')) != '')
                $library->password = Hash::make($request->input('password'));
            $library->update();
            success_message(trans('library.updated_successfully'));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
//            error_message(trans('library.updated_error'));
        }
        return redirect()->route('library.show');

    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        if (!$request->ajax())
            return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
        try {
            $library = Library::find($id);
            if (!$library)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.library_not_found')]);
            $library->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.removed_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.removed_error')]);
        }

    }

    function changeLibraryStatus(Request $request, $library_id = null, $status = '1')
    {
        if (!$request->ajax())
            return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
        try {
            $library = Library::find($library_id);
            if (!$library)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.library_not_found')]);
            $library->status = $status;
            $library->update();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.updated_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.updated_error')]);
        }


    }

    /**
     *
     * prepare data for datatable
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    function getAllLibraries(Request $request)
    {
        try {
            if (!$request->ajax())
                return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
            $library = Library::orderBy('created_at', 'desc')->where([]);
            if ($request->input('city') && $request->input('city') != '-1') {
                $library = Library::byCity($request->input('city'));
            }
            if ($request->input('area') && $request->input('area') != '-1') {
                $library = Library::byArea($request->input('area'), $request->input('city'));
            }
            if ($request->input('mobile')) {
                $library = $library->orWhere('mobile', 'like', '%' . $request->input('mobile') . '%');
            }
            if ($request->input('name')) {
                $library = $library->orWhere('name', 'like', '%' . $request->input('name') . '%');
            }
            if ($request->input('email')) {
                $library = $library->orWhere('email', 'like', '%' . $request->input('email') . '%');
            }
            if ($request->input('status')) {
                $library = $library->orWhere('status', 'like', '%' . $request->input('status') . '%');
            }
            if ($request->input('quarter')) {
                $library = $library->orWhere('quarter_id', 'like', '%' . $request->input('quarter') . '%');
            }
            $library = $library->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => 'done', 'data' => $library]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.show_error'), 'data' => []]);
        }
    }

    public function getAllRequests(Request $request, $library_id = null)
    {
        try {
            $userRequests = UserRequest::where('requests.library_id', '=', $library_id)->where([]);
            if ($request->input('client')) {
                $userRequests = UserRequest::byClient($request->input('client'))->where('requests.library_id', '=', $library_id);
            }
            if ($request->input('driver')) {
                $userRequests = UserRequest::byDriver($request->input('driver'))->where('requests.library_id', '=', $library_id);
            }
            if ($request->input('status') != '-1') {
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

    private function calculateInstitutionProfits($rate, $total)
    {
        return ($rate * $total) / 100;
    }

    /**
     *
     * set up validation rules for update and insert
     * @param $request
     * @param int $id
     * @return array
     */

    private function rules($request, $id = -1)
    {
        $rules = [
            'name' => 'required|String|min:3'

        ];
        $rules['commercial_record'] = 'required';

        if ($id != -1) {
            $rules['email'] = ['required', 'email', Rule::unique('admins', 'email')->ignore($id, 'id')];
            if ($request->input('password') && trim($request->input('password')) != '') {
                $rules['password'] = 'sometimes|required|min:6';
                $rules['confirm_password'] = 'same:password';
            }
        } else {
            $rules['phone'] = 'required|numeric|digits_between:1,15|regex:/^\d+$/';
            $rules['mobile'] = 'required|numeric|digits_between:1,15|regex:/^\d+$/';
            $rules['email'] = 'required|email';
            $rules['password'] = 'required|min:6';
            $rules['confirm_password'] = 'same:password';
            $rules['quarter'] = 'required|exists:quarters,id';
            $rules['inst_profit_rate'] = 'required|numeric|min:1|max:100';
            $rules['status'] = 'required|in:1,2';
        }
        return $rules;
    }


    /**
     * return all validation message according to system language
     * @return array
     */

    private function messages()
    {
        return [
            'name.required' => trans('library.name_required'),
            'name.String' => trans('library.name_string'),
            'name.min' => trans('library.name_min'),
            'name.regex' => trans('library.name_string'),
            'phone.required' => trans('library.phone_required'),
            'phone.numeric' => trans('library.phone_number'),
            'phone.digits_between' => trans('library.phone_min'),
            'phone.regex' => trans('library.phone_number'),
            'mobile.required' => trans('library.mobile_required'),
            'mobile.numeric' => trans('library.mobile_number'),
            'mobile.digits_between' => trans('library.mobile_min'),
            'mobile.regex' => trans('library.mobile_number'),
            'password.required' => trans('library.password_required'),
            'password.min' => trans('library.password_min'),
            'confirm_password.same' => trans('library.confirm_password_required'),
            'email.required' => trans('library.email_required'),
            'email.email' => trans('library.email_email'),
            'quarter.required' => trans('library.quarter_required'),
            'quarter.exists' => trans('library.quarter_exists'),
            'inst_profit_rate.required' => trans('library.inst_profit_rate_required'),
            'inst_profit_rate.numeric' => trans('library.inst_profit_rate_number'),
            'inst_profit_rate.min' => trans('library.inst_profit_rate_min'),
            'inst_profit_rate.max' => trans('library.inst_profit_rate_max'),
            'status.required' => trans('library.status_required'),
            'status.in' => trans('library.status_in'),
        ];
    }


}

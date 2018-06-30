<?php

namespace App\Http\Controllers\Drivers;

use App\Driver;
use App\UserPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverProfits extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param null $driver_id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $driver_id = null)
    {
        $userProfit = json_decode($request->input('body'));
        $driver = Driver::find($driver_id);
        try {
            if (!$driver)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('driver.not_found')]);
            $toBePayed = $this->calculateInstitutionRate($driver->instRate, $driver->total_profits, UserPayment::userPayments($driver->id));
            if ($userProfit->money > $toBePayed)
                return response()->json(['status' => PAYMENT_REQUIRED, 'message' => trans('library.more_than_enough_money')]);
            if ($userProfit->money <= $toBePayed && $userProfit->money > 0) {
//                $driver['total_profits'] = $driver->total_profits - $userProfit->money;
//                $driver->update();
                UserPayment::create([
                    'user_id' => $driver_id,
                    'money' => doubleval($userProfit->money),
                    'type' => $userProfit->type == '1' || $userProfit->type == '2' ? $userProfit->type : CACHE_TYPE,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.payment_saved_successfully')]);
        } catch (\Exception $exception) {
            if ($exception->getCode() == '22003')
                return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.not_enough_money')]);
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.payments_saved_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id = null)
    {
        try {
            $user_payments = UserPayment::where('user_id', $id)->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('driver.payment_show_successfully'), 'data' => $user_payments]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('driver.payment_show_serror'), 'data' => []]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userPayment = UserPayment::find($id);
        try {
            if (!$userPayment)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.payment_not_found'), 'data' => []]);
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.payment_show_successfully'), 'data' => $userPayment]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.payments_show_error'), 'data' => []]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $userProfit_new = json_decode($request->input('body'));
        $userPayment = UserPayment::find($id);
        if (!$userPayment)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('library.payment_not_found')]);
        $driver = $userPayment->user;
        if (!$driver)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('library.library_not_found')]);
        try {
            $toBePayed = $this->calculateInstitutionRate($driver->instRate, $driver->total_profits, UserPayment::userPayments($driver->id));
            if ($userProfit_new->money > $toBePayed)
                return response()->json(['status' => PAYMENT_REQUIRED, 'message' => trans('library.more_than_enough_money')]);
//            $library->total_profits = $library->total_profits + $libraryPayment->money;
//            $library->update();
//            $library->total_profits = $library->total_profits - $libraryProfit_new->money;
//            $library->update();
            if ($userProfit_new->money <= $toBePayed && $userProfit_new->money > 0) {
                $userPayment->money = $userProfit_new->money;
                $userPayment->type = $userProfit_new->type;
            }
            $userPayment->update();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.payment_updated_successfully')]);
        } catch (\Exception $exception) {
            if ($exception->getCode() == '22003')
                return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.not_enough_money')]);
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.payments_updated_error')]);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $driver_id
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($driver_id = null, $id = null)
    {
        $userPayment = UserPayment::find($id);
        $driver = Driver::find($driver_id);
        try {
            if (!$userPayment)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.payment_not_found')]);
            if (!$driver)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.library_not_found')]);
//            $library['total_profits'] = $library->total_profits + $libraryPayment->money;
//            $library->update();
            $userPayment->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.payment_deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.payments_deleted_error')]);
        }
    }


    public function getAllProfits(Request $request, $id = null)
    {

    }

    /**
     *
     *  Calculate how much library should pay for institution to be satisfied with its rate
     *
     * @param $rate
     * @param $total
     * @param $payed
     * @return float|int
     */

    private function calculateInstitutionRate($rate, $total, $payed)
    {
        $allInstitutionMoney = ($rate * $total) / 100;
        $toBePayed = $allInstitutionMoney - $payed;
        return $toBePayed;
    }
}

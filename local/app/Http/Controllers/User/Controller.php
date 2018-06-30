<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Request as UserRequest;
use App\UserPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{

    /**
     *
     * show user's profile
     *
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($id = null)
    {
        $user = User::find($id);
        if (!$user) {
            error_message(trans('driver.not_found'));
           return  redirect()->route('drivers.show');
        }
        $data['user'] = $user;
        $data['company'] = $user->company;
        $data['instPayedProfits'] = UserPayment::userPayments($id);
        $data['instProfits'] = $this->calculateInstitutionProfits($user->instRate, $user->total_profits);
        $data['resetPayment'] = $data['instProfits'] - $data['instPayedProfits'];
        $data['pureProfits'] = $user->total_profits - UserPayment::userPayments($id);
        return view('User.show', $data);
    }


    /**
     *
     * calculate institution's profit rate
     * @param $rate
     * @param $total
     * @return float|int
     */
    private function calculateInstitutionProfits($rate, $total)
    {
        return ($rate * $total) / 100;
    }

    /**
     *
     * get requests according to user's id
     * 
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllRequests(Request $request , $id = null)
    {
        try {
            $user = User::find($id);
            if(!$user)
                return response()->json(['status' => NOT_FOUND , 'message' => trans('user.not_found') , 'data' => []]);
            $userRequests = UserRequest::where([]);
            if ($request->input('client') && trim($request->input('client')) != "") {
                $userRequests = UserRequest::byClient($request->input('client'),$user->id);
            }
            if ($request->input('driver') && trim($request->input('driver'),$user->id) != "") {
                $userRequests = UserRequest::byDriver($request->input('driver'));
            }
            if ($request->input('status') && $request->input('status') != '-1') {
                $userRequests = $userRequests->where(['requests.status' => "" . $request->input('status')]);
            }
            if ($request->input('from')) {
                $userRequests = $userRequests->where('created_at', 'like', '%' . $request->input('from') . '%');
            }
            if ($request->input('to')) {
                $userRequests = $userRequests->where('delivery_time', 'like', '%' . $request->input('to') . '%');
            }
            if ($request->input('request_identifier')) {
                $userRequests = $userRequests->where('request_identifier' , 'like' , '%'.$request->input('request_identifier').'%');
            }
            if($user->type == CLIENT) {

                $userRequests = $userRequests->where(['requests.client_id' => $user->id])->get()->map(function ($item) {
                    $item->client;
                    $item->driver;
                    $item->book;
                    return $item;
                });

            }else{
                $userRequests = $userRequests->where(['requests.driver_id' => $user->id])->get()->map(function ($item) {
                    $item->client;
                    $item->driver;
                    $item->book;
                    return $item;
                });
            }
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('request.show_successfully'), 'data' => $userRequests]);
        } catch (\Exception $exception) {
//            return response()->json(['status' => SERVER_ERROR, 'message' =>$exception->getMessage(), 'data' => []]);
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('request.show_error'), 'data' => []]);
        }
    }
}

<?php

namespace App\Http\Controllers\Request;

use App\Book;
use App\Cart;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use App\Request as UserRequest;
use Mockery\Exception;

class Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $userRequest = UserRequest::find($id);
        if (!$userRequest) {
            error_message(trans('request.not_found'));
            return redirect()->route('request.show');
        }
        $userRequest['client'] = $userRequest->client;
        $userRequest['driver'] = $userRequest->driver;
        $userRequest['quarter'] = $userRequest->quarter;
        $userRequest['book'] = $userRequest->book;
        return view('Requests.info', compact('userRequest'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('Requests.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }



    public function getAllRequests(Request $request)
    {
        try {
            $userRequests = UserRequest::where([]);
            if ($request->input('client')) {
                $userRequests = UserRequest::byClient($request->input('client'));
            }
            if ($request->input('driver')) {
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
                $userRequests = $userRequests->where(['request_identifier' => $request->input('request_identifier')]);
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
        }
    }


    /**
     *
     * change request status to CONFIRMED
     *
     * @param Request $request
     * @param null $request_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmRequest(Request $request, $request_id = null)
    {

        $userRequest = UserRequest::find($request_id);
        if (!$userRequest) {
            return response()->json(['status' => NOT_FOUND, 'message' => trans('request.not_found')]);
        }
        try {
            $userRequest->status = CONFIRMED;
            $userRequest->updated_at = Carbon::now();
            $userRequest->update();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('request.request_confirmed_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('request.request_confirmed_error')]);
        }
    }


}

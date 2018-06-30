<?php

namespace App\Http\Controllers\Clients;

use App\Client;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        sessioned_title('client');
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
        return view('Clients.show');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id = null
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('client.not_found')]);
        try {
            $user->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' =>  trans('client.deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR , 'message' => trans('client.deleted_error')]);
        }

    }


    public function getAllClients(Request $request)
    {
        try {
            $clients = Client::orderBy('created_at', 'desc')->where([]);
            if ($request->input('phone')) {
                $clients = $clients->orWhere('phone', 'like', '%' . $request->input('phone') . '%');
            }
            if ($request->input('name')) {
                $clients = $clients->orWhere('name', 'like', '%' . $request->input('name') . '%');
            }
            if ($request->input('email')) {
                $clients = $clients->orWhere('email', 'like', '%' . $request->input('email') . '%');
            }
            if ($request->input('status') && $request->input('status') != '-1') {
                $clients = $clients->orWhere('status', '=', '' . $request->input('status'));
            }
            $clients = $clients->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('client.show_successfully'), 'data' => $clients]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('client.show_error'), 'data' => []]);
        }
    }


    public function changeStatus($client_id = null, $status = ACTIVE)
    {
        $user = User::find($client_id);
        if (!$user)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('client.not_found')]);
        try {
            $user->status = $status;
            $user->updated_at = Carbon::now();
            $user->update();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => $status == ACTIVE ? trans('client.activated') : trans('client.deactivated')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('client.status_changed_error')]);
        }

    }
}

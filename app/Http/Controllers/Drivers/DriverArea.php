<?php

namespace App\Http\Controllers\Drivers;

use App\Quarter;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\DriverArea as UserArea;

class DriverArea extends Controller
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
     * @param  int $user_id
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user_id = null)
    {
        $quarter = json_decode($request->input('body'));
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['status' => NOT_FOUND, 'message' => trans('driver.not_found')]);
        }
        $quarter = Quarter::find($quarter->id);
        if (!$quarter)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('driver.choose_are')]);
        try {
            UserArea::create([
                'user_id' => $user->id,
                'quarter_id' => $quarter->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('driver.area_stored_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('driver.area_stored_error')]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id = null)
    {
        try {
            $user = User::find($user_id);
            if (!$user)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('driver.user_not_found'), 'data' => []]);
            $driverAreas = $user->driverAreas()->orderBy('created_at', 'desc')->get()->map(function ($item) {
                $item->quarter;
                $item->quarter->city;
                $item->quarter->city->area;
                return $item;
            });
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('driver.driver_areas_fetched_successfully'), 'data' => $driverAreas]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('driver.driver_areas_fetched_error'), 'data' => []]);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $userArea = UserArea::find($id);
        try {
            if (!$userArea)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('driver.driver_area_not_found')]);
            $userArea->delete();
            return response()->json(['status' => SUCCESS_STATUS , 'message' => trans('driver.driver_area_deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR , 'message' => trans('driver.driver_area_deleted_error')]);
        }

    }
}

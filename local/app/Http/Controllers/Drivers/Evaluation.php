<?php

namespace App\Http\Controllers\Drivers;

use App\Driver;
use App\User;
use App\UserEvaluations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Evaluation extends Controller
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
     * @param  int $driver_id
     * @return \Illuminate\Http\Response
     */
    public function show($driver_id = null)
    {
        $driver = Driver::find($driver_id);
        if (!$driver) {
            error_message('driver.not_found');
            return redirect()->route('driver.show');
        }
        $evaluations = $driver->evaluations()->sum('evaluate');
        $evaluations_count = $driver->evaluations()->count();
        $driver['totalEvaluations'] = $this->calculateEvaluation($evaluations, $evaluations_count);
        return view('Drivers.evaluations', compact('driver'));

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
    public function destroy($id)
    {
        //
    }


    public function getAllEvaluations(Request $request, $id = null)
    {

        $driver = Driver::find($id);
        try {
            if (!$driver)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('driver.not_found')]);

            $evaluations = $driver->evaluations()->where([]);
            if (($request->input('client_name') && trim($request->input('client_name') != ''))) {
                $evaluations = UserEvaluations::byClient($request->input('client_name'), $id);
            }
            if (($request->input('client_phone') && trim($request->input('client_phone') != ''))) {
                $evaluations = UserEvaluations::byClient($request->input('client_phone'));
            }
            if ($request->input('request_identifier') && trim($request->input('request_identifier')) != '') {
                $evaluations = UserEvaluations::byRequest($request->input('request_identifier'), $id);
            }
            if ($request->input('from') && trim($request->input('from')) != '') {
                $evaluations = UserEvaluations::byRequest($request->input('from'), $id);
            }
            $evaluations = $evaluations->where(['user_evaluations.driver_id' => $id])->get()->map(function ($item) {
                $item->client;
                $item->driver;
                $item->request;
                return $item;
            });
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('driver.driver_fetched_successfully'), 'data' => $evaluations]);
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('driver.driver_fetched_error'), 'data' => []]);
        }

    }


    /**
     *
     * calculate evaluations
     * @param $sum
     * @param $count
     * @return float|int
     */

    private function calculateEvaluation($sum, $count)
    {
        if ($count == 0)
            return 0;
        return $sum / $count;

    }
}

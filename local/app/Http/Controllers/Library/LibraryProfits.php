<?php

namespace App\Http\Controllers\Library;

use App\Library;
use App\LibraryPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class LibraryProfits extends BaseController
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
     * @param  null $library_id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $library_id = null)
    {
        $libraryProfit = json_decode($request->input('body'));
        $library = Library::find($library_id);
        try {
            if (!$library)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.library_not_found')]);
            $toBePayed = $this->calculateInstitutionRate($library->instProfitRate, $library->total_profits, LibraryPayment::libraryPayments($library->id));
            if ($libraryProfit->money > $toBePayed)
                return response()->json(['status' => PAYMENT_REQUIRED, 'message' => trans('library.more_than_enough_money')]);
            LibraryPayment::create([
                'library_id' => $library_id,
                'money' => doubleval($libraryProfit->money),
                'type' => $libraryProfit->type == '1' || $libraryProfit->type == '2' ? $libraryProfit->type : CACHE_TYPE,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $libraryPayment = LibraryPayment::find($id);
        try {
            if (!$libraryPayment)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.payment_not_found')]);
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.payment_show_successfully'), 'data' => $libraryPayment]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.payments_show_error')]);
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
    public function update(Request $request, $id = null)
    {
        $libraryProfit_new = json_decode($request->input('body'));
        $libraryPayment = LibraryPayment::find($id);
        if (!$libraryPayment)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('library.payment_not_found')]);
        $library = $libraryPayment->library;
        if (!$library)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('library.library_not_found')]);
        try {
            $toBePayed = $this->calculateInstitutionRate($library->instProfitRate, $library->total_profits, LibraryPayment::libraryPayments($library->id));
            if ($libraryPayment->money > $toBePayed)
                return response()->json(['status' => PAYMENT_REQUIRED, 'message' => trans('library.more_than_enough_money')]);
//            $library->total_profits = $library->total_profits + $libraryPayment->money;
//            $library->update();
//            $library->total_profits = $library->total_profits - $libraryProfit_new->money;
//            $library->update();
            $libraryPayment->money = $libraryProfit_new->money;
            $libraryPayment->type = $libraryProfit_new->type;
            $libraryPayment->update();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.payment_updated_successfully')]);
        } catch (\Exception $exception) {
            if ($exception->getCode() == '22003')
                return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.not_enough_money')]);
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.payments_updated_error')]);

        }


    }

    /**
     * Remove the specified resource from storage and update library total profits
     * @param  int $library_id
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($library_id = null, $id = null)
    {
        $libraryPayment = LibraryPayment::find($id);
        $library = Library::find($library_id);
        try {
            if (!$libraryPayment)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.payment_not_found')]);
            if (!$library)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('library.library_not_found')]);
            $library['total_profits'] = $library->total_profits + $libraryPayment->money;
            $library->update();
            $libraryPayment->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.payment_deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.payments_deleted_error')]);
        }
    }

    public function getAllLibraryProfits($libraryId = null)
    {
        try {
            $libraryProfits = LibraryPayment::where('library_id', $libraryId)->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('library.payment_show_successfully'), 'data' => $libraryProfits]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('library.payments_show_error'), 'data' => []]);
        }
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

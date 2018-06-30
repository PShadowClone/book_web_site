<?php

namespace App\Http\Controllers\Offer;

use App\Library;
use App\Offer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
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
        return view('Offer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules($request), $this->messages());
        try {
            $offer = new Offer();
            $request['type'] = ALL_OFFER;
            $offer->fill($request->all());
            $offer->save();
            success_message(trans('offer.saved_successfully'));
        } catch (\Exception $exception) {
            error_message(trans('offer.saved_error'));
        }

        return redirect()->route('offer.show');
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('Offer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $offer = Offer::find($id);
        if (!$offer) {
            error_message(trans('offer.not_found'));
            return redirect()->route('offer.show');
        }
        return view('Offer.update', compact('offer'));
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
//        dd($request->input('book_offer_type'));
        $this->validate($request, $this->rules($request), $this->messages());
        try {
            $offer = Offer::find($id);
            if (!$offer) {
                error_message(trans('offer.not_found'));
                return redirect()->route('offer.show');
            }


            if ($request->input('book_offer_type') == '1') {
                $request['book_discount_rate'] = null;
            } else {
                $request['book_more_than'] = null;
                $request['from_book'] = null;

            }
//            dd($request->all());
            $request['type'] = ALL_OFFER;
            $offer->fill($request->all());
            $offer->update();
            success_message(trans('offer.saved_successfully'));
        } catch (\Exception $exception) {
//          dd($exception->getMessage());
            error_message(trans('offer.saved_error'));
        }
        return redirect()->route('offer.show');
    }

    public function delete(Request $request, $id = null)
    {
        $offer = Offer::find($id);
        if (!$offer)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('offer.not_found')]);
        try {
            $offer->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('offer.deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('offer.deleted_error')]);
        }
    }

    /**
     *
     * get all offers to be filled into datatable
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllOffers(Request $request)
    {
        try {
            $offers = Offer::with(['library', 'offeredBooks'])->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('offer.show_successfully'), 'data' => $offers]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('offer.show_error'), 'data' => []]);

        }
    }


    public function activateForAllLibraryBooks(Request $request, $offer_id = null, $library_id = null)
    {
        $offer = Offer::find($offer_id);
        if (!$offer)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('offer.not_found')]);
        $library = Library::find($library_id);
        if (!$library)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('library.not_found')]);
        try {
            $offer->library_id = $library->id;
            $offer->all_book = ALL_LIBRARY_BOOKS;
            $offer->updated_at = Carbon::now();
            $offer->update();
            $offer->offeredBooks()->where(['book_offers.library_id' => $library->id])->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('offer.offer_is_available_for_all_library_books')]);
        } catch (\Exception $exception) {

            return response()->json(['status' => SERVER_ERROR, 'message' => trans('offer.offer_is_available_for_all_library_books_error')]);
        }


    }

    /**
     * @param $request
     * @return array
     */
    private function rules($request)
    {
        $rules = [
            'title' => 'required|String',
            'start_date' => 'required',
            'expire_date' => 'required'
        ];
        if ($request->input('book_offer_type') == '1') {
            $rules['from_book'] = 'required|numeric';
            $rules['book_more_than'] = 'required|numeric';
        } else if ($request->input('book_offer_type') == '2') {
            $rules['book_discount_rate'] = 'required|numeric|between:0,100';
        }

        return $rules;

    }

    private function messages()
    {

        return [
            'title.required' => trans('offer.title_required'),
            'title.String' => trans('offer.title_string'),
            'start_date.required' => trans('offer.start_date_required'),
            'expire_date.required' => trans('offer.expire_date_required'),
            'from_book.required' => trans('offer.from_book_required'),
            'from_book.numeric' => trans('offer.from_book_numeric'),
            'book_more_than.required' => trans('offer.book_more_than_required'),
            'book_more_than.numeric' => trans('offer.book_more_than_numeric'),
            'book_discount_rate.numeric' => trans('offer.book_discount_rate_numeric'),
            'book_discount_rate.required' => trans('offer.book_discount_rate_required'),
            'book_discount_rate.between' => trans('offer.book_discount_rate_between'),
        ];
    }
}

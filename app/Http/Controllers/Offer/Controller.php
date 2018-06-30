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
            $inserted_data = [
                'title' => $request->input('title'),
                'start_date' => $request->input('start_date'),
                'expire_date' => $request->input('expire_date'),
                'type' => $request->input('offer_type')
            ];
            if ($request->input('offer_type') == BUY_OFFER) {
                $inserted_data['buy_offer_type'] = $request->input('buy_offer_type');
                $inserted_data['more_than'] = $request->input('more_than');
                $inserted_data['buy_discount_rate'] = $request->input('buy_discount_rate');
            } else if ($request->input('offer_type') == BOOK_OFFER) {
                $inserted_data['book_offer_type'] = $request->input('book_offer_type');
                if ($inserted_data['book_offer_type'] == FREE_DELIVERING) {
                    $inserted_data['from_book'] = $request->input('from_book');
                    $inserted_data['book_more_than'] = $request->input('book_more_than');
                } else {
                    $inserted_data['book_discount_rate'] = $request->input('book_discount_rate');
                }
            }
            Offer::create($inserted_data);
//            $request['type'] = ALL_OFFER;
//            $offer->fill($request->all());
//            $offer->save();
            success_message(trans('offer.saved_successfully'));
        } catch (\Exception $exception) {
            dd($exception);
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
//       dd($request->all());
        $this->validate($request, $this->rules($request), $this->messages());
        try {
            $offer = Offer::find($id);
            if (!$offer) {
                error_message(trans('offer.not_found'));
                return redirect()->route('offer.show');
            }

            $updated_data = [
                'title' => $request->input('title'),
                'start_date' => $request->input('start_date'),
                'expire_date' => $request->input('expire_date'),
                'type' => $request->input('offer_type')
            ];

            if (strval($request->input('offer_type')) == BUY_OFFER) {
                $updated_data['buy_offer_type'] = $request->input('buy_offer_type');
                $updated_data['more_than'] = $request->input('more_than');
                $updated_data['buy_discount_rate'] = $request->input('buy_discount_rate');
                $updated_data['book_offer_type'] =null;
                $updated_data['from_book'] = null;
                $updated_data['book_more_than'] = null;
                $updated_data['book_discount_rate'] = null;
            } else {
                $updated_data['book_offer_type'] = $request->input('book_offer_type');
                if ($updated_data['book_offer_type'] == FREE_DELIVERING) {
                    $updated_data['from_book'] = $request->input('from_book');
                    $updated_data['book_more_than'] = $request->input('book_more_than');
                    $updated_data['book_discount_rate'] =null;

                } else {
                    $updated_data['book_discount_rate'] = $request->input('book_discount_rate');
                    $updated_data['from_book'] = null;
                    $updated_data['book_more_than'] = null;
                }

                $updated_data['buy_offer_type'] = null;
                $updated_data['more_than'] = null;
                $updated_data['buy_discount_rate'] = null;
            }
//            if ($request->input('book_offer_type') == '1') {
//                $request['book_discount_rate'] = null;
//            } else {
//                $request['more_than'] = null;
//                $request['from_book'] = null;
//
//            }
//            dd($request->all());
//            $request['type'] = ALL_OFFER;
            $offer->fill($updated_data);
            $offer->update();
            success_message(trans('offer.saved_successfully'));
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            error_message(trans('offer.saved_error'));
        }
        return redirect()->route('offer.show');
    }

    /**
     *
     * delete offer
     *
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
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
            'expire_date' => 'required',
            'offer_type' => 'required'
        ];
        if($request->input('offer_type') == BOOK_OFFER){
            if($request->input('book_offer_type') == FREE_DELIVERING){
                $rules['from_book'] = 'required|numeric';
                $rules['book_more_than'] = 'required|numeric';
//                $rules['book_discount_rate'] = 'required|numeric';
            }else{
                $rules['book_discount_rate'] = 'required|numeric';
            }
        }else{
            $rules['buy_discount_rate'] = 'required|numeric';
            $rules['more_than'] = 'required|numeric';
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
            'more_than.required' => trans('offer.more_than_required'),
            'more_than.numeric' => trans('offer.more_than_numeric'),
        ];
    }
}

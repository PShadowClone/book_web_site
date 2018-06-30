<?php

namespace App\Http\Controllers\Cart;

use App\Book;
use App\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Request as BookRequest;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class Controller extends BaseController
{

    /**
     * *************************************
     *
     *          ADD TO CART
     *
     * *************************************
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(Request $request)
    {

        try {
            $content = json_decode($request->input('body'));
            $book = Book::with(['library'])->find($content->id);
            if (!$book)
                return ajax_response(NOT_FOUND, trans('book.web.requested_book_not_found'));
            $library = $book->library;
            if (!$library)
                return ajax_response(NOT_FOUND, trans('book.web.requested_library_not_found'));
            $bookCheck = BookRequest::where(['book_id' => $book->id])->whereIn('status', [FOR_CONFIRMING, CONFIRMED, PAYED, UNDER_PREPARING, PREPARED, DELIVERING])->first();
            if ($bookCheck)
                return ajax_response(REQUESTED_BEFORE, trans('request.web.requested_before'));
            $bookRequest['book_id'] = $book->id;
            $bookRequest['library_id'] = $library->id;
            $bookRequest['client_id'] = Auth::id();
            $bookRequest['request_identifier'] = random_int(MIN_RANDOM, MAX_RANDOM);
            $bookRequest['created_at'] = Carbon::now();
            $bookRequest['updated_at'] = Carbon::now();
            $bookRequest['status'] = FOR_CONFIRMING;
            $bookRequest['book_amount'] = $content->amount;
            $requestResult = BookRequest::create($bookRequest);
            if (!$requestResult)
                return ajax_response(SERVER_ERROR, trans('request.web.can_not_store_request'));
            $cart['request_id'] = $requestResult->id;
            $cart['client_id'] = Auth::id();
            $cart['book_id'] = $book->id;
            $cart['library_id'] = $library->id;
            $cart['created_at'] = Carbon::now();
            $cart['updated_at'] = Carbon::now();
            $cart = Cart::create($cart);
            if (!$cart)
                return ajax_response(SERVER_ERROR, trans('cart.web.can_not_store_cart'));
            return ajax_response(SUCCESS_STATUS, trans('request.web.stored_successfully'));
        } catch (\Exception $exception) {
            return ajax_response(SERVER_ERROR, trans('lang.web.can_not_store'));
        }

    }

    /**
     * show cart's page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('Cart.web.index');
    }


    public function showDelivery()
    {
        return view('Cart.web.make_delivery');
    }
}

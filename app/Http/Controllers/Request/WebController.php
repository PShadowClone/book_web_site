<?php

namespace App\Http\Controllers\Request;

use App\Book;
use App\Cart;
use App\Request as UserRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SuperClosure\Exception\SuperClosureException;

class WebController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        $userRequest = UserRequest::find($id);
        if (!$userRequest)
            return ajax_response(NOT_FOUND, trans('request.web.request_not_found'));
        $cart = Cart::where(['request_id' => $userRequest->id])->first();
        if (!$cart)
            return ajax_response(NOT_FOUND, trans('request.web.cart_not_found'));
        try {
            if ($userRequest->status > intval(CONFIRMED)) {
                try {
                    $book = Book::find($userRequest->book_id);
                    $book->amount = $book->amount + $userRequest->book_amount;
                    $book->updated_at = Carbon::now();
                    $book->update();
                } catch (\Exception $exception) {
                    return ajax_response(NOT_FOUND, trans('book.web.not_found'));
                }
            }
            $cart->delete();
            $userRequest->delete();
            return ajax_response(SUCCESS_STATUS, trans('requests.web.removed_successfully'));
        } catch (\Exception $exception) {
            return ajax_response(SERVER_ERROR, trans('request.web.can_not_remove_requests'));
        }
    }


    /**
     *
     * show the information of requested book by using request's id
     *
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRequestedBook($id = null)
    {
        $userRequest = UserRequest::find($id);
        if (!$userRequest)
            return ajax_response(NOT_FOUND, trans('request.web.request_not_found'));
        $book = $userRequest->book;
        if (!$book)
            return ajax_response(NOT_FOUND, trans('book.web.not_found'));
        try {
            $book['requested_amount'] = $userRequest->book_amount;
            $book['request_id'] = $userRequest->id;
            $book['request_identifier'] = $userRequest->request_identifier;
            return ajax_response(SUCCESS_STATUS, trans('request.web.fetched_successfully'), $book);
        } catch (\Exception $exception) {
            return ajax_response(SERVER_ERROR, trans('request.web.show_request_error'));
        }
    }


    /**
     *
     * update the requested amount
     *
     * @param Request $request
     * @param null $id
     * @param null $book_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id = null, $book_id = null)
    {
        $content = json_decode($request->input('body'));
        $userRequest = UserRequest::where(['id' => $id, 'book_id' => $book_id])->first();
        if (!$userRequest)
            return ajax_response(NOT_FOUND, trans('request.web.request_not_found'));
        $book = $userRequest->book;
        if (!$book)
            return ajax_response(NOT_FOUND, trans('book.web.not_found'));
        if ($book->amount < $content->book_amount)
            return ajax_response(SERVER_ERROR, trans('request.web.amount_not_enough'));
        try {
            $userRequest->book_amount = $content->book_amount;
            $userRequest->status = FOR_CONFIRMING;
            $userRequest->update();
            return ajax_response(SUCCESS_STATUS, trans('request.web.updated_successfully'));
        } catch (\Exception $exception) {
            return ajax_response(SERVER_ERROR, trans('request.web.updated_error'));
        }
    }


    /**
     *
     * send requests for libraries to check it's books
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendConfirmingRequest(Request $request)
    {
        $requests = cart_requests()->where(['requests.status' => FOR_CONFIRMING])->orWhere('requests.status', '=', CONFIRMED)->groupBy('cart.library_id')->get();
        if (!$requests)
            return ajax_response(NOT_FOUND, trans('request.web.not_found_s'));
        try {
            $requests = UserRequest::hydrate($requests->toArray());
            $requests->map(function ($item) {
                $item->status = FOR_CONFIRMING;
                $item->updated_at = Carbon::now();
                $item->update();
                return $item;
            });
            return ajax_response(SUCCESS_STATUS, trans('request.web.confirming_requests_sent'));
        } catch (\Exception $exception) {
            return ajax_response(SERVER_ERROR, trans('request.web.confirming_error'));
        }
    }


    /**
     *
     * check if requests can be delivered or not
     *
     * @param Request $request
     * @param null $request_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function completeRequestsDelivery(Request $request, $request_id = null)
    {
        if (check_delivery($request_id))
            return ajax_response(SUCCESS_STATUS, trans('request.web.redirect_to_delivery'), 'link');
        else
            return ajax_response(NOT_FOUND, trans('request.web.can_not_make_delivery_for_all_requests'));
    }
}

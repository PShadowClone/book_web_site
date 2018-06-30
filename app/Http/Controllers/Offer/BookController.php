<?php

namespace App\Http\Controllers\Offer;

use App\Book;
use App\BookOffer;
use App\Library;
use App\Offer;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
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
        //
    }

    /**
     * @param null $library_id
     * @param Request $request
     * @param null $offer_id
     * @param null $book_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $offer_id = null, $book_id = null, $library_id = null)
    {
        $offer = Offer::find($offer_id);
        $book = Book::find($book_id);
        try {
            if (!$offer)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('offer.not_found'), 'data' => []]);
            if ($book_id != -1) {
                if ($book_id != -1 && !$book)
                    return response()->json(['status' => NOT_FOUND, 'message' => trans('book.not_found'), 'data' => []]);
                $library = $book->library;
                if (!$library)
                    return response()->json(['status' => NOT_FOUND, 'message' => trans('library.not_found'), 'data' => []]);

                if ($offer->library_id == $library->id && $offer->all_book == ALL_LIBRARY_BOOKS)
                    return response()->json(['status' => SERVER_ERROR, 'message' => trans('offer.existed_offer_library_all')]);

            }
            if ($book_id != -1) {
                $check = BookOffer::where(['library_id' => $library_id, 'offer_id' => $offer_id, 'all_book' => ALL_LIBRARY_BOOKS])->count();
                if ($check > 0)
                    return response()->json(['status' => SERVER_ERROR, 'message' => trans('offer.existed_offer_library_all')]);
            }
            $bookOffer = new BookOffer();
            $bookOffer->offer_id = $offer->id;
            $bookOffer->library_id = $library_id;
            if ($book_id == '-1') {
                $bookOffer->all_book = ALL_LIBRARY_BOOKS;
                $bookOffer->book_id = null;
                $this->deleteOfferedBook($offer_id, $library_id);
            } else {
                $bookOffer->all_book = NOT_ALL_LIBRARY_BOOKS;
                $bookOffer->book_id = $book_id;
            }
            $bookOffer->save();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('offer.book_offer_saved_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('book.book_offer_saved_error')]);
//            return response()->json(['status' => SERVER_ERROR, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function delete($offerId = null, $offeredBookId = null)
    {
        $offer = Offer::find($offerId);
        if (!$offer)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('offer.not_found')]);
        $offeredBook = BookOffer::where(['offer_id' => $offer->id, 'id' => $offeredBookId])->first();
        if (!$offeredBook)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('offer.offered_book_not_found')]);

        try {
            $offeredBook->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('offer.offered_book_deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('offer.offered_book_deleted_error')]);
        }
    }

    /**
     *
     * this function is respnsible to delete all library books form offer
     * because there is another changes that make offer available for all library's books
     * @param $offer_id
     * @param $library_id
     * @throws \Exception
     */
    public function deleteOfferedBook($offer_id, $library_id)
    {
        try {
            BookOffer::where(['offer_id' => $offer_id, 'library_id' => $library_id])->delete();
        } catch (\Exception $exception) {
            throw $exception;
        }
    }


    public function getBooks(Request $request, $libraryId = null)
    {
        $library = Library::find($libraryId);
        if (!$libraryId)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('library.not_found'), 'data' => []]);
        try {
            $books = $library->books;
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('book.show_successfully'), 'data' => $books]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('book.show_error'), 'data' => []]);
        }
    }

    /**
     *
     * get all offered books and their libraries
     * @param Request $request
     * @param null $offer_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllOfferedBooks(Request $request, $offer_id = null)
    {

        try {
            $response = collect();
            BookOffer::where(['offer_id' => $offer_id])->with(['library', 'offer', 'book'])->get()->map(function ($item) use ($response) {
                $response->push(['offeredBook' => $item,'book_name' => $item->book ? $item->book->name : null, 'library' => $item->library, 'book_all' => $item->all_book, 'offer' => $item->offer]);
            });
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('offer.offered_books_show_successfully'), 'data' => $response]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('offer.offered_books_show_error'), 'data' => []]);

        }


    }
}

<?php

namespace App\Http\Controllers\Book;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    /**
     * returns the result of searched items
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function search(Request $request)
    {
        $book = Book::where([]);
        $books = $this->conditions($book, $request)->paginate(SEARCH_BOOK_PAGINATION);
        return view('Books.web.search', compact('books'));
    }


    /**
     *
     * handles all searched conditions
     *
     * @param $book
     * @param Request $request
     * @return mixed
     */
    private function conditions($book, Request $request)
    {
        if ($request->has('book_id'))
            $book = $book->where(['id' => $request->input('book_id')]);
        if ($request->has('category_id') && $request->input('category_id') != '-1')
            $book = $book->where(['category_id' => $request->input('category_id')]);
        if ($request->has('library_id') && $request->input('library_id') != '-1')
            $book = $book->where(['library_id' => $request->input('library_id')]);
        if ($request->has('book_name'))
            $book = $book->where('name', 'like', '%' . $request->input('book_name') . '%');
        if ($request->has('book_writer'))
            $book = $book->where('writer', 'like', '%' . $request->input('book_writer') . '%');
        if ($request->has('book_publisher'))
            $book = $book->where('publisher', 'like', '%' . $request->input('book_publisher') . '%');
        if ($request->has('book_inquisitor'))
            $book = $book->where('inquisitor', 'like', '%' . $request->input('book_inquisitor') . '%');
        return $book;
    }
}

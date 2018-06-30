<?php

namespace App\Http\Controllers\Book;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WebController extends Controller
{

    /**
     *
     * get the details of book
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id = null)
    {
        $book = Book::with(['category', 'evaluations', 'library'])->find($id);
        if (!$book)
            throw new NotFoundHttpException(trans('book.book_no_found'));
        $book['offeredPrice'] = $book->getOfferedPrice();
        $book['related_books'] = $book->getRelatedBooks();
        $data['book'] = $book;
        return view('Books.web.index', $data);
    }
}

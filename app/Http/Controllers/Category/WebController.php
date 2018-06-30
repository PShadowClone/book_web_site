<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function books($id = null)
    {
        $category = Category::find($id);
        if (!$category)
            echo 'not found';
        $books = $category->books()->paginate(CATEGORY_BOOKS);
        return view('Categories.web.books', compact('category'), compact('books'));
    }


    public function show()
    {
        $books = books();
        return view('Categories.web.categories', compact('books'));
    }
}

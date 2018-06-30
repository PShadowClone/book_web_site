<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{

    public function show()
    {
        return view('Home.web.index');
    }
}

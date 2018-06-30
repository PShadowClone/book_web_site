<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{

    /**
     *
     * show the main page of control panel
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return redirect()->route('admin.show');
    }

    public function notFound(){
        return view('404_notFound');
    }
}

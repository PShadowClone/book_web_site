<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    public function index()
    {
        return view('Login.index');
    }


    public function check(Request $request)
    {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->route(REDIRECT_URL);
        } else if (Auth::attempt(['email' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->route(REDIRECT_URL);
        }
        return redirect()->back()->with('error', trans('lang.login_error'));
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }


}

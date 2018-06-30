<?php

namespace App\Http\Controllers\auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        dd('sh');
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        // specify the guard that should be used for login attempts
        return Auth::guard('admin');
    }

    protected function attemptLogin(Request $request)
    {
        return parent::attemptLogin($request);
    }
}

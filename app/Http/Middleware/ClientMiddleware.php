<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->ajax()) {
            if (!Auth::check()) {
                return response()->json(['status' => 401, 'message' => trans('lang.web.login_auth'), 'data' => []]);
            }
        }
        if (!Auth::check()) {
            return route('web.login.show');
        }


        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Login;

use App\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPassword extends BaseController
{

    /**
     *
     * send email to user
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request)
    {
        $admin = Admin::where(['email' => $request->input('email')])->first();
        if (!$admin)
            return redirect()->route('login')->with('error', trans('lang.email_not_found'));
        $admin->remember_token = csrf_token();
        $admin->updated_at = Carbon::now();
        $admin->update();
        if (!$admin)
            return redirect()->route('login')->with('error', trans('lang.email_not_found'));
        $result = send_email($admin->email, project_name(), trans('lang.change_password'), ['email' => $admin->email, 'token' => $admin->remember_token]);

        return redirect()->route('login')->with('success', trans('lang.email_sent_changed'));
    }


    /**
     *
     * show reset password view
     *
     *
     * @param Request $request
     * @param $email
     * @param $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetView(Request $request, $email, $token)
    {
        return view('Login.reset', ['email' => $email, 'token' => $token]);

    }

    /**
     *
     * make resetting
     *
     *
     * @param Request $request
     * @param $email
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request, $email, $token)
    {
        $admin = Admin::where(['email' => $email])->first();
        if (!$admin)
            return redirect()->route('login')->with('error', trans('lang.email_not_found'));
        if ($admin->remember_token != $token)
            return redirect()->route('login')->with('error', trans('lang.session_out'));
        $this->validate($request, $this->rules(), $this->messages());
        try {
            $admin->password = Hash::make($request->input('password'));
            $admin->remember_token = null;
            $admin->updated_at = Carbon::now();
            $admin->update();
            return redirect()->route('login')->with('success', trans('lang.password_reset_successfully'));
        } catch (\Exception $exception) {
            return redirect()->route('login')->with('error', trans('lang.password_reset_error'));
        }

    }


    private function rules()
    {
        return [
            'password' => 'required|min:6',
            'confirm_password' => 'same:password'
        ];
    }

    private function messages()
    {
        return [
            'password.required' => trans('admin.password_required'),
            'password.min' => trans('admin.password_min'),
            'confirm_password.same' => trans('admin.confirm_password_required'),
        ];
    }
}

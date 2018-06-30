<?php

namespace App\Http\Controllers\Login;

use App\Client;
use App\Library;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    use AuthenticatesUsers;

    /**
     *
     * show login page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('Login.web.login');
    }

    /**
     *
     * show forget password's panel
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showForgottenPassword()
    {
        return view('login.web.forget_password');
    }


    /**
     *
     * send email to user for changing user's password
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forgetPasswordAction(Request $request)
    {
        $admin = User::where(['email' => $request->input('email')])->first();
        if (!$admin)
            return redirect()->back()->with('error', trans('lang.email_not_found'));
        $admin->remember_token = csrf_token();
        $admin->updated_at = Carbon::now();
        $admin->update();
        if (!$admin)
            return redirect()->back()->with('error', trans('lang.email_not_found'));
        $result = send_email($admin->email, project_name(), trans('lang.change_password'), ['email' => $admin->email, 'token' => $admin->remember_token]);

        return redirect()->route('web.login.show')->with('success', trans('lang.email_sent_changed'));
    }

    /**
     * make login into system
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */

    public function login(Request $request)
    {
//        dd('normalLogin');
        $validator = Validator::make($request->all(), $this->rules(), $this->messages());
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $result = Auth::attempt(['email' => $request->input('username'), 'password' => 'e10adc3949ba59abbe56e057f20f883e']);
//        $result = Auth::guard('client')->attempt(['email' => $request->input('username'), 'password' => $request->input('password')]);
//        dd($result);
        if ($user = User::where(['email' => $request->input('username'), 'password' => md5($request->input('password'))])->first()) {
            Auth::login($user);
            Session::put('guard', User::class);
            return redirect()->route('web.home.show');
        } else if ($user = User::where(['phone' => $request->input('username'), 'password' => md5($request->input('password'))])->first()) {
            Auth::login($user);
            Session::put('guard', User::class);
            return redirect()->route('web.home.show');
        } else if ($user = Library::where(['phone' => $request->input('username'), 'password' => md5($request->input('password'))])->first()) {
            Auth::login($user);
            Session::put('guard', Library::class);
            return redirect()->oute('web.home.show');
        } else if ($library = Library::where(['email' => $request->input('username'), 'password' => md5($request->input('password'))])->first()) {
            Auth::login($library);
            Session::put('guard', Library::class);
            return redirect()->route('web.home.show');
        }
        return redirect()->back()->with('error', trans('login.web.username_or_password'));

    }


    /**
     *
     * show register page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegister()
    {
        return view('Login.web.register');
    }


    public function register(Request $request)
    {
        $this->validate($request, self::registerRules(), self::registerMessages());
        $user = new User();
        $user->type = CLIENT;
        $user->password = md5($request->input('password'));
        $user->fill($request->all());
        $user->save();
        return redirect()->back()->with('success', trans('client.web.registered_successfully'));

    }


    /**
     *
     * log out according to authentication users
     *
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
//        $result = Session::get('guard');
////        $result = Auth::guard($result)->logout();
        return redirect()->route('web.home.show');
    }


    private function registerRules()
    {
        $rules = [
            'name' => 'required|String'

        ];

        $rules['email'] = 'required|email|unique:users,email';
        $rules['password'] = 'required|min:6';
        $rules['confirm_password'] = 'same:password';
        $rules['phone'] = 'required|min:5,max:15|unique:users,phone';
        $rules['email'] = 'required|email';
        $rules['password'] = 'required|min:6';
        $rules['confirm_password'] = 'same:password';


        return $rules;
    }

    private function registerMessages()
    {
        return [
            'name.required' => trans('admin.name_required'),
            'name.string' => trans('admin.name_string'),
            'name.regex' => trans('admin.name_string'),
            'phone.required' => trans('user.validation.phone_required'),
            'phone.unique' => trans('user.validation.phone_unique'),
            'email.required' => trans('admin.email_required'),
            'email.email' => trans('admin.email_email'),
            'password.required' => trans('admin.password_required'),
            'password.min' => trans('admin.password_min'),
            'confirm_password.same' => trans('user.validation.confirm_password_required'),
        ];
    }

    /**
     * login validation rules
     *
     * @return array
     */
    private function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * login validation messages
     *
     * @return array
     */
    private function messages()
    {
        return [
            'username.required' => trans('lang.username_password_required'),
            'password.required' => trans('lang.username_password_required')
        ];
    }
}

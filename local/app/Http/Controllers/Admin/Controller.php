<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Controller extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        sessioned_title('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin.create');
    }

    /**
     * Store a admin's attributes.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, self::rules($request), self::messages());
        try {
            Admin::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'type' => ORDINARY_ADMIN
            ]);
            success_message(trans('admin.stored_successfully'));
        } catch (\Exception $exception) {
            error_message(trans('admin.stored_error'));
        }
        return redirect()->route('admin.show');

    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

        return view('Admin.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id = null
     * @return \Illuminate\Http\Response
     */
    public function edit($id = null)
    {
        $adminAuth = Auth::user();
        $admin = Admin::find($id);
        if (!$admin) {
            error_message(trans('admin.admin not found'));
            return redirect()->route('admin.show');
        }
        if ($admin->type == SUPER_ADMIN) {
            error_message(trans('admin.cannot_edit'));
            return redirect()->route('admin.show');
        }
        return view('Admin.update', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id = null
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {

        $admin = Admin::find($id);
        if (!$admin) {
            error_message(trans('admin.admin_not_found'));
            return redirect()->route('admin.show');
        }
        $this->validate($request, self::rules($request, $id), self::messages());
        try {
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            if ($request->input('password') && trim($request->input('password')) != '') {
                $admin->password = Hash::make($request->input('password'));
            }
            $admin->update();
            success_message(trans('admin.updated_successfully'));
        } catch (\Exception $exception) {
            error_message(trans('admin.admin not found'));
        }
        return redirect()->route('admin.show');

    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        $adminAuth = Auth::user();

        if ($adminAuth->type != SUPER_ADMIN || $adminAuth->id == $id)
            return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => trans('admin.no_permissions'), 'data' => []]);

        if (!$request->ajax())
            return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
        try {
            $admin = Admin::find($id);
            if (!$admin)
                return response()->json(['status' => NOT_FOUND, 'message' => trans('admin.admin not found')]);
            if ($admin->id == $adminAuth->id)
                return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => trans('admin.illegal_remove')]);
            if ($admin->type == "" . SUPER_ADMIN)
                return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => trans('admin.illegal_remove')]);
            $admin->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('admin.removed_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('admin.removed_error')]);

        }
    }


    function getAllAdmins(Request $request)
    {
        if (!$request->ajax())
            return response()->json(['status' => ILLEGAL_ACCESS_CODE, 'message' => ILLEGAL_ACCESS, 'data' => []]);
        try {
            $admins = Admin::orderBy('admins.id', 'desc')->where([]);
            if ($request->input('username')) {
                $admins = $admins->orWhere('username', 'like', '%' . $request->input('username') . '%');
            }
            if ($request->input('name')) {
                $admins = $admins->orWhere('name', 'like', '%' . $request->input('name') . '%');
            }
            if ($request->input('email')) {
                $admins = $admins->orWhere('email', 'like', '%' . $request->input('email') . '%');
            }


            $admins = $admins->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('admin.show_successfully'), 'data' => $admins]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('admin.show_error'), 'data' => []]);
        }

    }

    private function rules($request, $id = -1)
    {
        $rules = [
            'name' => 'required|String|min:6'

        ];
        if ($id != -1) {
            $rules['email'] = ['required', 'email', Rule::unique('admins', 'email')->ignore($id, 'id')];
            if ($request->input('password') && trim($request->input('password')) != '') {
                $rules['password'] = 'sometimes|required|min:6';
                $rules['confirm_password'] = 'same:password';
            }
        } else {
            $rules['username'] = 'required|String|min:6';
            $rules['email'] = 'required|email';
            $rules['password'] = 'required|min:6';
            $rules['confirm_password'] = 'same:password';
        }

        return $rules;

    }

    private function messages()
    {

        return [
            'name.required' => trans('admin.name_required'),
            'name.string' => trans('admin.name_string'),
            'name.regex' => trans('admin.name_string'),
            'name.min' => trans('admin.name_min'),
            'username.required' => trans('admin.username_required'),
            'username.string' => trans('admin.username_string'),
            'username.regex' => trans('admin.username_string'),
            'username.min' => trans('admin.username_min'),
            'email.required' => trans('admin.email_required'),
            'email.email' => trans('admin.email_email'),
            'password.required' => trans('admin.password_required'),
            'password.min' => trans('admin.password_min'),
            'confirm_password.same' => trans('admin.confirm_password_required'),
        ];

    }
}

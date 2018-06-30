<?php

namespace App\Http\Controllers\Settings;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class controller extends BaseController
{

    /**
     * show create page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('Settings.store');
    }


    /**
     *
     * save new discount into setting table
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules(), $this->message());
        try {
            $setting = new Setting();
            $setting->fill($request->all());
            $setting->save();
            success_message(trans(('setting.saved_successfully')));
        } catch (\Exception $exception) {
            error_message(trans('setting.saved_error'));
        }

        return redirect()->back();
    }


    /**
     *
     * validation rules
     * @return array
     */
    private function rules()
    {
        return [
            'in_city' => 'required|numeric|digits_between:0,100',
            'out_city' => 'required|numeric|digits_between:0,100',
        ];
    }


    /**
     *
     * validation messages
     * @return array
     *
     */
    private function message()
    {
        return [
            'in_city.required' => trans('setting.in_city_required'),
            'in_city.numeric' => trans('setting.in_city_numeric'),
            'in_city.digits_between' => trans('setting.in_city_digits_between'),
            'out_city.required' => trans('setting.out_city_required'),
            'out_city.numeric' => trans('setting.out_city_numeric'),
            'out_city.digits_between' => trans('setting.out_city_digits_between'),

        ];
    }
}

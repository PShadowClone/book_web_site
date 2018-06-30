<?php

namespace App\Http\Controllers\Settings;

use App\PromoCodes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends BaseController
{


    /**
     * store new promo code into datatabse
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $admin_id = Auth::user()->id;
        $data = json_decode($request->input('body'));
        if (!$data->discount_rate)
            return response()->json(['status' => VALIDATION_ERROR, 'message' => trans('setting.discount_rate_required')]);
        if ($data->discount_rate < 0 || $data->discount_rate > 100) {
            return response()->json(['status' => VALIDATION_ERROR, 'message' => trans('setting.discount_rate_digits_between')]);
        }
//        $code = str_random(PROMOCODE_LENGTH);
        $code = $data->promo_code; // get it by user

        $tempPromo = PromoCodes::where(['code' => $code])->first();
        if($tempPromo)
            return response()->json(['status' => VALIDATION_ERROR, 'message' => trans('setting.promo_already_exist')]);

        try {
            PromoCodes::create([
                'admin_id' => $admin_id,
                'discount_rate' => $data->discount_rate,
                'code' => $code
            ]);
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('setting.promo_saved_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('setting.promo_saved_error')]);
        }
    }

    /**
     *
     * get all promocodes which are available in the system
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getAllPromoCodes(Request $request)
    {
        try {
            $promoCodes = PromoCodes::where([]);
            if ($request->input('client') && trim($request->input('client')))
                $promoCodes = PromoCodes::byClient($request->input('client'));
            if ($request->input('code'))
                $promoCodes = $promoCodes->where('code', 'like', '%' . $request->input('code') . '%');
            $promoCodes = $promoCodes->get();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('setting.promo_show_successfully'), 'data' => $promoCodes]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('setting.promo_show_error'), 'data' => []]);
        }
    }

    public function delete(Request $request, $id = null)
    {
        $promoCodes = PromoCodes::find($id);
        if (!$promoCodes)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('setting.promo_not_found')]);
        try {
            $promoCodes->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('setting.promo_removed_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('setting.promo_removed_error')]);

        }

    }
}

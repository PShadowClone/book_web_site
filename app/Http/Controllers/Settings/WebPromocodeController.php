<?php

namespace App\Http\Controllers\Settings;

use App\ClientPromoCodes;
use App\PromoCodes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WebPromocodeController extends Controller
{


    public function assign(Request $request)
    {
        $content = json_decode($request->input('body'));
        $promoCode = PromoCodes::where(['code' => trim($content->promo_code)])->first();
        if (!$promoCode)
            return ajax_response(NOT_FOUND, trans('setting.web.promo_code_not_found'));
        $clientPromoCode = ClientPromoCodes::where(['client_id' => Auth::id(), 'promo_id' => $promoCode->id])->first();
        if ($clientPromoCode)
            return ajax_response(REQUESTED_BEFORE, trans('setting.web.promo_code_assigned_before'));
        try {
            $clientPromoCode = [
                'client_id' => Auth::id(),
                'promo_id' => $promoCode->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $result = ClientPromoCodes::create($clientPromoCode);
            return ajax_response(SUCCESS_STATUS, trans('setting.web.assigned_successfully'), $result);
        } catch (\Exception $exception) {
            return ajax_response(SERVER_ERROR, trans('setting.web.assigned_error'));
        }
    }
}

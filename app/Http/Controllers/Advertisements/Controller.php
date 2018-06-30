<?php

namespace App\Http\Controllers\Advertisements;

use App\Advertisement;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{


    /**
     *
     * show advertisements's form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("Advertisements.create");
    }

    /**
     *
     * open advertisement's edit form according to advertisement's id
     *
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id = null)
    {
        $advertisement = Advertisement::find($id);
        if (!$advertisement) {
            error_message(trans('ads.not_found'));
            return redirect()->route('ads.show');
        }
        return view('Advertisements.update', compact('advertisement'));
    }

    /**
     *
     * store new advertisement into database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules(), $this->messages());
        try {
            $advertisement = new Advertisement();
            $request['image'] = image_upload($request->file('ads_image'), ADS_DIR)['data'];
            $advertisement->fill($request->all());
            $advertisement->save();
            success_message(trans("ads.saved_successfully"));
        } catch (\Exception $exception) {
            error_message(trans("ads.saved_error"));
        }

        return redirect()->route('ads.show');
    }

    /**
     *
     * update advertisement's data according to advertisement's id
     *
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request , $id = null)
    {
        $this->validate($request, $this->rules(true), $this->messages());
        $advertisement = Advertisement::find($id);
        if(!$advertisement){
            error_message(trans('ads.not_found'));
            return redirect()->route('ads.show');
        }
        try {
            if ($request->file('ads_image')) {
                $request['image'] = image_update($advertisement->image, $request->file('ads_image'), ADS_DIR)['data'];
            }
            $advertisement->fill($request->all());
            $advertisement->updated_at = Carbon::now();
            $advertisement->update();
            success_message(trans('ads.updated_successfully'));
        }catch (\Exception $exception){
            error_message(trans('ads.updated_error'));
        }
        return redirect()->route('ads.show');
    }

    /**
     * show the list of system's advertisements
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function display()
    {
        return view("Advertisements.show");
    }

    /**
     *
     * retrieve all advertisements to be displayed in advertisements table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllAds(Request $request)
    {
        try {
            $advertisements = Advertisement::orderBy('id', 'desc')->where([]);
            if ($request->input('contact_phone') && trim($request->input('contact_phone')) != '')
                $advertisements = $advertisements->where('contact_phone', 'like', '%' . $request->input('contact_phone') . '%');
            if ($request->input('start_publish') && $request->input('end_publish'))
                $advertisements = $advertisements->whereBetween('start_publish', array($request->input('start_publish') . " 00:00:00", $request->input('end_publish') . " 00:00:00"));
            $advertisements = $advertisements->get();
            return response()->json(['status' => SUCCESS_STATUS, "message" => trans('ads.show_successfully'), 'data' => $advertisements]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, "message" => trans('ads.show_error'), 'data' => []]);

        }
    }

    /**
     *
     * remove advertisement according to advertisement's id
     *
     * @param Request $request
     * @param null $adsId
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request, $adsId = null)
    {
        $advertisement = Advertisement::find($adsId);
        if (!$advertisement)
            return response()->json(['status' => NOT_FOUND, 'message' => trans("ads.not_found")]);
        try {
            $advertisement->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('ads.deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('ads.deleted_error')]);
        }
    }


    /**
     *
     * validation rules
     * @param bool $update
     * @return array
     */
    private function rules($update = false)
    {
        if ($update)
            return [
                'content' => 'required',
                'contact_phone' => 'required|digits_between:5,15',
                'arrange' => 'required|numeric',
                'start_publish' => 'required',
                'end_publish' => 'required'
            ];
        else
            return [
                'content' => 'required',
                'ads_image' => 'required',
                'contact_phone' => 'required|digits_between:5,15',
                'arrange' => 'required|numeric',
                'start_publish' => 'required',
                'end_publish' => 'required'
            ];
    }

    /**
     * validation messages
     * @return array
     */
    private function messages()
    {
        return [
            'content.required' => trans('ads.content_required'),
            'ads_image.required' => trans("ads.image_required"),
            'arrange.required' => trans("ads.arrange_required"),
            'arrange.numeric' => trans("ads.arrange_numeric"),
            "contact_phone.required" => trans("ads.contact_phone_required"),
            "contact_phone.digits_between" => trans("ads.contact_phone_digits_between"),
            "start_publish.required" => trans("ads.start_publish_required"),
            "end_publish.required" => trans("ads.end_publish_required")
        ];
    }
}

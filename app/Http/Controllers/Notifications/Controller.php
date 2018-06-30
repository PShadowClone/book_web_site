<?php

namespace App\Http\Controllers\Notifications;

use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Symfony\Component\Process\ExecutableFinder;

class Controller extends BaseController
{

    /**
     *
     * show notifications' table which lists all notification that have been sent from system's admins
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function show()
    {
        return view('Notifications.show');
    }


    /**
     * return all system notifications to datatable to be filled into it
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getAllNotifications()
    {
        try {
            $notifications = Notification::all()->map(function ($item) {
                switch ($item->type) {
                    case CLIENT_NOTIFICATION :
                        $item['data'] = $item->client;
                        break;
                    case DRIVER_NOTIFICATION :
                        $item['data'] = $item->driver;
                        break;
                    case LIBRARY_NOTIFICATION :
                        $item['data'] = $item->library;
                        break;
                    default:
                        $item['data'] = null;
                }
                return $item;
            });
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('notify.show_successfully'), 'data' => $notifications]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('notify.show_error'), 'data' => []]);
        }
    }

    /**
     *
     * store new notification
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $admin_id = 1;
        $notificationData = json_decode($request->input('body'));
        try {
            $data = [
                'content' => $notificationData->content,
                'type' => $notificationData->type,
                'admin_id' => $admin_id
            ];
            if ($notificationData->to == '-1') {
                $data['type_all'] = TYPE_ALL;
            } else {
                $data['type_all'] = TYPE_NOT_ALL;
                $data['to'] = $notificationData->to;
            }

            $notification = Notification::create($data);

            switch ($notification->type) {
                case CLIENT_NOTIFICATION:
                    if ($notification->type_all == TYPE_ALL)
                        $tokens = clients()->pluck('token')->toArray();
                    else
                        $tokens = clients($notification->to)->token;
                    break;
                case DRIVER_NOTIFICATION:
                    if ($notification->type_all == TYPE_ALL)
                        $tokens = drivers()->pluck('token')->toArray();
                    else
                        $tokens = drivers($notification->to)->token;
                    break;
                case LIBRARY_NOTIFICATION:
                    if ($notification->type_all == TYPE_ALL)
                        $tokens = libraries()->pluck('token')->toArray();
                    else
                        $tokens = libraries($notification->to)->token;
                    break;
                default:
                    $tokens = [];
            }
            notify($tokens, trans('lang.notificationFromAdmin'), $notification->content, trans('lang.notificationFromAdmin'), SYSTEM_NOTIFICATION);
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('notify.saved_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('notify.saved_error')]);
        }
    }


    /**
     *
     * this function returns data according to given type
     *
     *  ***********************
     *  *   Type Conditions   *
     *  ***********************
     *
     * type == 1 returns clients
     * type == 2 returns drivers
     * type == 3 returns libraries
     *
     *
     * @param Request $request
     * @param null $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTypeData(Request $request, $type = null)
    {

        try {

            switch ($type) {
                case CLIENT_NOTIFICATION:
                    $data = clients();
                    break;
                case DRIVER_NOTIFICATION:
                    $data = drivers();
                    break;
                case LIBRARY_NOTIFICATION:
                    $data = libraries();
                    break;
                default:
                    $data = [];
            }
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('notify.type_data_fetched_successfully'), 'data' => $data]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('notify.type_data_fetched_error'), 'data' => []]);

        }
    }

    /**
     *
     *  resend notification according to notification's id
     *
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */

    public function reSend(Request $request, $id = null)
    {

        $notification = Notification::find($id);
        if (!$notification)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('notify.not_found')]);

        try {
            switch ($notification->type) {
                case CLIENT_NOTIFICATION:
                    if ($notification->type_all == TYPE_ALL)
                        $tokens = clients()->pluck('token')->toArray();
                    else
                        $tokens = clients($notification->to)->token;
                    break;
                case DRIVER_NOTIFICATION:
                    if ($notification->type_all == TYPE_ALL)
                        $tokens = drivers()->pluck('token')->toArray();
                    else
                        $tokens = drivers($notification->to)->token;
                    break;
                case LIBRARY_NOTIFICATION:
                    if ($notification->type_all == TYPE_ALL)
                        $tokens = libraries()->pluck('token')->toArray();
                    else
                        $tokens = libraries($notification->to)->token;
                    break;
                default:
                    $tokens = [];
            }
            notify($tokens, trans('lang.notificationFromAdmin'), $notification->content, trans('lang.notificationFromAdmin'), SYSTEM_NOTIFICATION);
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('notify.resend_successfully')]);

        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('notify.reSend_error')]);
        }
    }


    public function delete(Request $request, $id = null)
    {
        $notification = Notification::find($id);
        if (!$notification)
            return response()->json(['status' => NOT_FOUND, 'message' => trans('notify.not_found')]);
        try {
            $notification->delete();
            return response()->json(['status' => SUCCESS_STATUS, 'message' => trans('notify.deleted_successfully')]);
        } catch (\Exception $exception) {
            return response()->json(['status' => SERVER_ERROR, 'message' => trans('notify.deleted_error')]);

        }

    }

    private function rules()
    {
        return [
            'content' => 'required',
            'type' => 'required|between:1,2,3',
            'to' => 'required'
        ];
    }

    private function messages()
    {
        return [
            'content.required' => trans('notify.content_required'),
            'type.required' => trans('notify.type_required'),
            'type.between' => trans('notify.type_between'),
            'to' => trans('notify.to_required')
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Area;
use App\Book;
use App\Category;
use App\City;
use App\Client;
use App\Driver;
use App\Library;
use App\Notification;
use App\Quarter;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Snowfire\Beautymail\Beautymail;

class HelperController extends Controller
{
    // this function contains request header for destroy previous page cache
    static function removeCache()
    {
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
    }

    /**
     *     type = 1 is success
     *     type = 2 is error
     *
     */
    static function message($message, $type = 1)
    {
        session()->flash($type == 1 ? 'success' : 'error', $message);

    }

    static function sessioned_title($title = null)
    {
        session()->forget('title');
        session(['title' => $title]);
        session()->put('title', $title);
    }

    /**
     *
     * returns all system areas
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */

    static function areas($id = null)
    {
        if ($id)
            return Area::find($id);
        else
            return Area::all();
    }

    /**
     *
     * returns all system cities
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */

    static function cities($id = null)
    {
        if ($id)
            return City::find($id);
        else
            return City::all();
    }

    /**
     *
     * returns all system quarters
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     *
     */

    static function quarters($id = null)
    {
        if ($id)
            return Quarter::find($id);
        else
            return Quarter::all();
    }


    /**
     *
     *  handel all image uploading in the system
     * @param $image
     * @param string $folder
     * @return array
     */
    static function upload_image($image, $folder = 'pic')
    {
        try {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
           $destinationPath = str_replace('/local/public' , '',public_path('/' . $folder)).'/';
            if (!file_exists($destinationPath))
                mkdir($destinationPath);
            $image->move($destinationPath, $imageName);
            return ['status' => SUCCESS_STATUS, 'message' => trans('lang.image_uploaded_successfully'), 'data' => '/' . $folder . '/' . $imageName];
        } catch (\Exception $exception) {
            return ['status' => SERVER_ERROR, 'message' => trans('lang.image_uploaded_error'), 'data' => ''];
        }

    }

    /**
     *
     * update all images in the system
     *
     *
     * @param $old_image
     * @param $new_image
     * @param string $folder
     * @return array
     * @throws \Exception
     */

    static function update_image($old_image, $new_image, $folder = 'pic')
    {
        if (!$new_image)
            return ['data' => $old_image];
        try {
            if (File::exists($old_image))
                File::delete($old_image);
            return self::upload_image($new_image, $folder);
        } catch (\Exception $exception) {
            throw new \Exception(trans('category.update_image_error'));
        }
    }

    /**
     * get all libraries available in system
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */

    static function libraries($id = null)
    {
        if ($id)
            return Library::find($id);
        return Library::all();
    }

    /**
     *
     * get all book in system according to book's id or library's id
     * @param null $vars
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */

    static function books($vars = null)
    {
        if (is_array($vars))
            return Book::where($vars)->get();
        if (!$vars)
            return Book::all();
        return Book::find($vars);

    }

    /**
     * get all libraries available in system
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */

    static function categories($id = null)
    {
        if ($id)
            return Category::find($id);
        return Category::all();
    }

    /**
     * get all system's clients
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    static function clients($id = null)
    {
        if ($id)
            return Client::find($id);
        return Client::all();
    }

    /**
     * get all system's drivers
     * @param null $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    static function drivers($id = null)
    {
        if ($id)
            return Driver::find($id);
        return Driver::all();
    }

    /**
     *
     * handel all email sending operations
     *
     * @throws \Exception
     * @param $email
     * @param $title
     * @param $subject
     * @param array $data
     * @return bool
     */
    static function sendEmail($email, $title, $subject, $data = array())
    {
        try {
            $beautymail = app()->make( Beautymail::class);

            $beautymail->send('emails.welcome', $data, function ($message) use ($email, $title, $subject) {

                $message->from(env('MAIL_USERNAME'), $title);
                $message->to($email)->subject($subject);
            });
            return true;
        } catch (\Exception $exception) {
            throw $exception;
        }

    }

    /**
     *
     * push system's notification
     *
     * @throws \Exception
     * @param $token
     * @param $title
     * @param $content
     * @param $body
     * @param $type
     * @param int $badge
     * @param string $tagName
     * @return array
     */
    static function notify($token, $title, $content, $body, $type, $badge = 1, $tagName = 'data')
    {
        $result = Notification::notify($token, $title, $content, $body, $type, $badge, $tagName);
        return $result;
    }


    /**
     * return the last setting discount system have got.
     *
     * @return mixed
     */
    static function lastSettingDiscount()
    {
        $discount = Setting::all()->last();
        return $discount;
    }

    /**
     *
     * print the status of request according to request's status number
     * @param null $status
     * @return string
     */
    static function request_status($status = null)
    {
        if (!$status)
            return '';
        switch ($status) {
            case '1':
                return 'لتأكيد';
            case '2':
                return 'مؤكد';
            case '3':
                return 'تم الشراء';
            case '4':
                return 'جاري التحضير';
            case '5':
                return 'تم التحضير';
            case '6':
                return 'جاري التوصيل';
            case '7':
                return 'تم التسليم';
            case '8':
                return 'ملغي';
        }

    }

}

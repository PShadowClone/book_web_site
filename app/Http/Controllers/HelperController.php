<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\Area;
use App\Book;
use App\Cart;
use App\Category;
use App\City;
use App\Client;
use App\Driver;
use App\Library;
use App\Notification;
use App\Offer;
use App\Quarter;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Snowfire\Beautymail\Beautymail;
use App\Request as BookRequest;

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
            $destinationPath = str_replace('/local/public', '', public_path('/' . $folder)) . '/';
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
        return Library::orderBy('id', 'desc')->get();
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
            return Book::orderBy('id', 'asc')->get();
        return Book::find($vars);

    }

    /**
     *
     * get list of books according to category conditions
     *
     * @param null $vars
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    static function books_by_category($vars = null)
    {
        if (is_array($vars)) {
            $category = Category::where($vars)->first();
            if (!$category)
                return collect();
            return $category->books()->orderBy('id', 'desc')->get();
        }
        if (!$vars) {
            return collect();
        }
        $category = Category::find($vars);
        if (!$category)
            return collect();
        return $category->books()->orderBy('id', 'desc')->get();
    }

    /**
     *
     * get list of books according to library conditions
     *
     * @param null $vars
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static[]
     */
    static function books_by_library($vars = null)
    {
        if (is_array($vars)) {
            $library = Library::where($vars)->first();
            if (!$library)
                return collect();
            return $library->books()->orderBy('id', 'desc')->get();
        }
        if (!$vars) {
            return collect();
        }
        $library = Library::find($vars);
        if (!$library)
            return collect();
        return $library->books()->orderBy('id', 'desc')->get();
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
        return Category::orderBy('id', 'desc')->get();
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
            $beautymail = app()->make(Beautymail::class);

            $result = $beautymail->send('emails.welcome', $data, function ($message) use ($email, $title, $subject) {

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


    /**
     *
     * prints evaluation rating as stars
     *
     * @param null $book
     * @return string
     */
    static function show_book_rating($book = null)
    {
        $result = '';
        if (!$book)
            return $result;
        for ($counter = 0; $counter < $book->getEvaluationRating(); $counter++) {
            $result .= '<i class="fa fa-star" ></i >';
        }
        for ($counter = 0; $counter < (5 - $book->getEvaluationRating()); $counter++) {
            $result .= '<i class="fa fa-star-o" ></i >';
        }
        return $result;
    }


    /**
     *
     * get the top rated books
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    static function top_rated_books($limit = BOOK_NUMBER_HOME)
    {
        return Book::top_rated($limit);
    }

    /**
     *
     * get the top requested books
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    static function top_requested_books($limit = BOOK_NUMBER_HOME)
    {
        return Book::top_requested($limit);
    }

    /**
     *
     * get the top liked books
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    static function top_liked_books($limit = BOOK_NUMBER_HOME)
    {
        return Book::top_liked($limit);
    }

    /**
     *
     * get available website's ads
     *
     * @param null $id
     * @return $this|\Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection|null|static
     */
    static function get_available_ads($id = null)
    {
        return Advertisement::getAvailableAds($id);
    }

    /**
     *
     * ************************************
     *          GET DISTANCE
     * ************************************
     *
     * this function get the nearest distances in the given table in addition to get
     * specific number of records
     *
     * @param $latitude
     * @param $longitude
     * @param $table
     * @param int $limit
     * @return mixed
     */
    static function nearestDistances($latitude, $longitude, $table, $limit = LIMIT_ROWS)
    {
        return DB::select(DB::raw('SELECT *, ( 3959 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians(latitude) ) ) ) AS distance FROM ' . $table . ' ORDER BY distance asc limit ' . $limit));
    }


    /**
     *
     * returns user's cart
     *
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    static function cart($conditions = array())
    {
        return Book::join('requests', 'requests.book_id', '=', 'books.id')
            ->where(['client_id' => Auth::id()])
            ->where($conditions)
            ->select(['books.*'])
            ->get();
    }


    /**
     *
     * returns the client's liked books
     *
     * @param null $id
     * @return Book
     */
    static function liked_books($id = null)
    {
        return Book::likedBooks($id);
    }

    /**
     *
     * returns the last available offer
     *
     * @return mixed
     */
    static function available_offers()
    {
        return Offer::whereDate('start_date', '<=', Carbon::now())->whereDate('expire_date', '>=', Carbon::now())->get()->last();
    }


    /**
     *
     *
     * calculate the offered price for book
     *
     * @param $price
     * @param $discount
     * @return float|int
     */
    static function calculate_book_discount($price, $discount)
    {
        return ($price - (($price * $discount) / 100));
    }

    /**
     *
     *
     * get authenticated user cause there is wrong with login guard
     *
     * @return mixed
     */
    static function user()
    {
        $guardName = Session::get('guard');
        /*//        dd($guardName);*/
        $user = '\\' . $guardName::where(['id' => Auth::id()])->first();
        return $user;
    }


    /**
     *
     * handles the returned ajax responses
     *
     * @param $status
     * @param $message
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    static function ajax_response($status, $message, $data)
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data]);
    }


    /**
     *
     * returns all cart books (Note: different developing times)
     *
     */
    static function cart_books($paginated = false)
    {
        return Book::requestedBooks($paginated);
    }


    /**
     *
     * calculates the all details about cart's financial
     *
     * @return int
     */
    static function cart_total()
    {
        return Cart::cartTotal();
    }


    /**
     *
     * return cart's requests
     *
     * @param bool $flag
     * @return $this|array
     */
    static function cart_requests($flag = false)
    {
        return Cart::requests($flag);
    }


    /**
     * *******************************************
     *
     *              CHECK REQUEST
     *
     * *******************************************
     *
     * this function checks if the requests or single request is ready
     * to be delivered according to the common condition
     *
     * @if requests.confirming_date <= (LEGAL_TIME which is 30)
     * @return TRUE
     * @else
     * @return FALSE
     *
     * @NOTE: all conditions done in database side
     *
     * @param null $request_id
     * @return bool
     */
    static function check_delivery($request_id = null)
    {
        return Cart::checkDelivery($request_id);
    }
}

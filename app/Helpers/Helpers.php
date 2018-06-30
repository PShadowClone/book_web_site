<?php

if (!function_exists('project_name')) {
    function project_name()
    {
        return env('PROJECT_NAME');
    }
}

if (!function_exists('destroy_cache')) {
    function destroy_cache()
    {
        \App\Http\Controllers\HelperController::removeCache();
    }
}

if (!function_exists('success_message')) {
    function success_message($message)
    {
        \App\Http\Controllers\HelperController::message($message);
    }
}
if (!function_exists('error_message')) {
    function error_message($message)
    {
        \App\Http\Controllers\HelperController::message($message, 2);
    }
}
if (!function_exists('sessioned_title')) {
    function sessioned_title($title)
    {
        \App\Http\Controllers\HelperController::sessioned_title($title);
    }
}
if (!function_exists('areas')) {
    function areas($id = null)
    {
        return \App\Http\Controllers\HelperController::areas($id);
    }
}
if (!function_exists('cities')) {
    function cities($id = null)
    {
        return \App\Http\Controllers\HelperController::cities($id);
    }
}
if (!function_exists('quarters')) {
    function quarters($id = null)
    {
        return \App\Http\Controllers\HelperController::quarters($id);
    }
}
if (!function_exists('image_upload')) {
    function image_upload($image, $folder = 'pic')
    {
        return \App\Http\Controllers\HelperController::upload_image($image, $folder);
    }
}

if (!function_exists('image_update')) {
    function image_update($old_image, $new_image, $folder = 'pic')
    {
        try {
            return \App\Http\Controllers\HelperController::update_image($old_image, $new_image, $folder);
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}

if (!function_exists('libraries')) {
    function libraries($id = null)
    {
        return \App\Http\Controllers\HelperController::libraries($id);
    }
}

if (!function_exists('categories')) {
    function categories($id = null)
    {
        return \App\Http\Controllers\HelperController::categories($id);
    }
}

if (!function_exists('request_status')) {
    function request_status($status = null)
    {
        return \App\Http\Controllers\HelperController::request_status($status);
    }
}


if (!function_exists('books')) {
    function books($vars = null)
    {
        return \App\Http\Controllers\HelperController::books($vars);
    }
}

if (!function_exists('clients')) {
    function clients($id = null)
    {
        return \App\Http\Controllers\HelperController::clients($id);
    }
}

if (!function_exists('drivers')) {
    function drivers($id = null)
    {
        return \App\Http\Controllers\HelperController::drivers($id);
    }
}


if (!function_exists('notify')) {
    function notify($token, $title, $content, $body, $type, $badge = 1, $tagName = 'data')
    {
        return \App\Http\Controllers\HelperController::notify($token, $title, $content, $body, $type, $badge, $tagName);
    }
}

if (!function_exists('system_discount')) {
    function system_discount()
    {
        return \App\Http\Controllers\HelperController::lastSettingDiscount();
    }
}

if (!function_exists('send_email')) {
    function send_email($email, $title, $subject, $data = array())
    {
        return \App\Http\Controllers\HelperController::sendEmail($email, $title, $subject, $data);
    }
}

if (!function_exists('books_by_category')) {
    function books_by_category($vars = null)
    {
        return \App\Http\Controllers\HelperController::books_by_category($vars);
    }
}

if (!function_exists('books_by_library')) {
    function books_by_library($vars = null)
    {
        return \App\Http\Controllers\HelperController::books_by_library($vars);
    }
}

if (!function_exists('show_book_rating')) {
    function show_book_rating($book = null)
    {
        return \App\Http\Controllers\HelperController::show_book_rating($book);
    }
}


if (!function_exists('top_rated_books')) {
    function top_rated_books($limit = BOOK_NUMBER_HOME)
    {
        return \App\Http\Controllers\HelperController::top_rated_books($limit);
    }
}

if (!function_exists('top_requested_books')) {
    function top_requested_books($limit = BOOK_NUMBER_HOME)
    {
        return \App\Http\Controllers\HelperController::top_requested_books($limit);
    }
}

if (!function_exists('top_liked_books')) {
    function top_liked_books($limit = BOOK_NUMBER_HOME)
    {
        return \App\Http\Controllers\HelperController::top_liked_books($limit);
    }
}


if (!function_exists('available_ads')) {
    function available_ads($id = null)
    {
        return \App\Http\Controllers\HelperController::get_available_ads($id);
    }
}

if (!function_exists('nearest_distances')) {
    function nearest_distances($latitude, $longitude, $table, $limit = LIMIT_ROWS)
    {
        return \App\Http\Controllers\HelperController::nearestDistances($latitude, $longitude, $table, $limit);
    }
}

if (!function_exists('cart')) {
    function cart($conditions = array())
    {
        return \App\Http\Controllers\HelperController::cart($conditions);
    }
}


if (!function_exists('user')) {
    function user()
    {
        return \App\Http\Controllers\HelperController::user();
    }
}


if (!function_exists('available_offers')) {
    function available_offers()
    {
        return \App\Http\Controllers\HelperController::available_offers();
    }
}

if (!function_exists('calculate_book_discount')) {
    function calculate_book_discount($price, $discount)
    {
        return \App\Http\Controllers\HelperController::calculate_book_discount($price, $discount);
    }
}


if (!function_exists('liked_books')) {
    function liked_books($id = null)
    {
        return \App\Http\Controllers\HelperController::liked_books($id);
    }
}

if (!function_exists('ajax_response')) {
    function ajax_response($status, $message, $data = [])
    {
        return \App\Http\Controllers\HelperController::ajax_response($status, $message, $data);
    }
}

if (!function_exists('cart_books')) {
    function cart_books($paginated = false)
    {
        return \App\Http\Controllers\HelperController::cart_books($paginated);
    }
}


if (!function_exists('cart_total')) {
    function cart_total()
    {
        return \App\Http\Controllers\HelperController::cart_total();
    }
}


if (!function_exists('cart_requests')) {
    function cart_requests($flag = false)
    {
        return \App\Http\Controllers\HelperController::cart_requests($flag);
    }
}


if (!function_exists('check_delivery')) {
    function check_delivery($request_id = null)
    {
        return \App\Http\Controllers\HelperController::check_delivery($request_id);
    }
}



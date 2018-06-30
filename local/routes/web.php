<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['uses' => 'Home\Controller@notFound']);


Route::get('/login', ['as' => 'login', 'uses' => 'Login\Controller@index']);
Route::post('/forget/password', ['as' => 'forget.password', 'uses' => 'Login\ForgetPassword@sendEmail']);
Route::post('/login', ['as' => 'login.check', 'middleware' => 'guest', 'uses' => 'Login\Controller@check']);
Route::get('/reset/{email}/{token}', ['as' => 'password.reset.show', 'middleware' => 'guest', 'uses' => 'Login\ForgetPassword@showResetView']);
Route::post('/reset/{email}/{token}', ['as' => 'password.reset', 'middleware' => 'guest', 'uses' => 'Login\ForgetPassword@reset']);
/**
 *
 * Admin urls
 *
 */

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/dashboard', ['as' => 'home', 'uses' => 'Home\Controller@index']);
    Route::group(['prefix' => 'admin', 'namespace' => '\Admin',], function () {
        Route::get('/create', ['as' => 'admin.create', 'uses' => 'Controller@create']);
        Route::post('/create', ['as' => 'admin.store', 'uses' => 'Controller@store']);
        Route::get('/show', ['as' => 'admin.show', 'uses' => 'Controller@show']);
        Route::get('/update/{id?}', ['as' => 'admin.edit', 'uses' => 'Controller@edit']);
        Route::post('/update/{id?}', ['as' => 'admin.update', 'uses' => 'Controller@update']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'admin.show.all', 'uses' => 'Controller@getAllAdmins']);
            Route::delete('/remove/{id?}', ['as' => 'admin.remove', 'uses' => 'Controller@destroy']);
        });
    });

    /**
     *
     * Library urls
     *
     */

    Route::group(['prefix' => 'library', 'namespace' => '\Library'], function () {
        Route::get('/create', ['as' => 'library.create', 'uses' => 'Controller@create']);
        Route::post('/create', ['as' => 'library.store', 'uses' => 'Controller@store']);
        Route::get('/show', ['as' => 'library.show', 'uses' => 'Controller@show']);
        Route::get('/update/{id?}', ['as' => 'library.edit', 'uses' => 'Controller@edit']);
        Route::post('/update/{id?}', ['as' => 'library.update', 'uses' => 'Controller@update']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'library.show.all', 'uses' => 'Controller@getAllLibraries']);
            Route::get('/show/profit/{id?}', ['as' => 'library.profits.show', 'uses' => 'LibraryProfits@show']);
            Route::get('/show/request/{library_id?}', ['as' => 'library.request.show', 'uses' => 'Controller@getAllRequests']);
            Route::get('/profits/{library_id?}', ['as' => 'library.profits.show.all', 'uses' => 'LibraryProfits@getAllLibraryProfits']);
            Route::post('/profits/save/{library_id?}', ['as' => 'library.profits.save', 'uses' => 'LibraryProfits@store']);
            Route::put('/change/{library_id?}/{status?}', ['as' => 'library.status.change', 'uses' => 'Controller@changeLibraryStatus']);
            Route::put('/update/profit/{id?}', ['as' => 'library.profit.update', 'uses' => 'LibraryProfits@update']);
            Route::delete('/remove/{id?}', ['as' => 'library.remove', 'uses' => 'Controller@destroy']);
            Route::delete('/remove/profit/{library_id?}/{id?}', ['as' => 'library.profit.remove', 'uses' => 'LibraryProfits@destroy']);
        });
    });


    Route::group(['prefix' => 'driver', 'namespace' => '\Drivers'], function () {
        Route::get('/create', ['as' => 'driver.create', 'uses' => 'Controller@create']);
        Route::post('/create', ['as' => 'driver.store', 'uses' => 'Controller@store']);
        Route::get('/show', ['as' => 'driver.show', 'uses' => 'Controller@show']);
        Route::get('/evaluations/{id?}', ['as' => 'driver.evaluations.show', 'uses' => 'Evaluation@show']);
        Route::get('/update/{id?}', ['as' => 'driver.edit', 'uses' => 'Controller@edit']);
        Route::post('/update/{id?}', ['as' => 'driver.update', 'uses' => 'Controller@update']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'driver.show.all', 'uses' => 'Controller@getAllDrivers']);
            Route::get('/show/profit/{id?}', ['as' => 'driver.profits.show', 'uses' => 'DriverProfits@show']);
            Route::get('/show/request/{driver_id?}', ['as' => 'driver.request.show', 'uses' => 'Controller@getAllRequests']);
            Route::get('/show/areas/{id?}', ['as' => 'driver.areas.show', 'uses' => 'DriverArea@show']);
            Route::get('/show/areas/{id?}', ['as' => 'driver.areas.show', 'uses' => 'DriverArea@show']);
            Route::get('/update/profit/{id?}', ['as' => 'driver.profits.edit', 'uses' => 'DriverProfits@edit']);
            Route::get('/evaluations/{id?}', ['as' => 'driver.evaluations.show.all', 'uses' => 'Evaluation@getAllEvaluations']);
            Route::post('/profits/save/{user_id?}', ['as' => 'driver.profits.save', 'uses' => 'DriverProfits@store']);
            Route::post('/area/save/{user_id?}', ['as' => 'driver.area.save', 'uses' => 'DriverArea@store']);
            Route::put('/change/status/{id?}/{status?}', ['as' => 'driver.change.status', 'uses' => 'Controller@changeStatus']);
            Route::put('/update/profit/{id?}', ['as' => 'driver.profit.update', 'uses' => 'DriverProfits@update']);
            Route::delete('/remove/{id?}', ['as' => 'driver.remove', 'uses' => 'Controller@destroy']);
            Route::delete('/remove/profit/{driver_id?}/{id?}', ['as' => 'driver.profit.remove', 'uses' => 'DriverProfits@destroy']);
            Route::delete('/remove/area/{id?}', ['as' => 'driver.area.remove', 'uses' => 'DriverArea@destroy']);
        });
    });

    Route::group(['prefix' => 'client', 'namespace' => '\Clients'], function () {
        Route::get('/show', ['as' => 'client.show', 'uses' => 'Controller@show']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'client.show.all', 'uses' => 'Controller@getAllClients']);
            Route::put('/status/change/{client_id?}/{id?}', ['as' => 'client.change.status', 'uses' => 'Controller@changeStatus']);
            Route::delete('/remove/{id?}', ['as' => 'client.remove', 'uses' => 'Controller@destroy']);
        });
    });

    Route::group(['prefix' => 'category', 'namespace' => '\Category'], function () {
        Route::get('/create', ['as' => 'category.create', 'uses' => 'Controller@create']);
        Route::post('/create', ['as' => 'category.store', 'uses' => 'Controller@store']);
        Route::get('/update/{id?}', ['as' => 'category.edit', 'uses' => 'Controller@edit']);
        Route::post('/update/{id?}', ['as' => 'category.update', 'uses' => 'Controller@update']);
        Route::get('/show', ['as' => 'category.show', 'uses' => 'Controller@show']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'category.show.all', 'uses' => 'Controller@getAllCategories']);
            Route::delete('/remove/{id?}', ['as' => 'category.remove', 'uses' => 'Controller@destroy']);
        });
    });


    Route::group(['prefix' => 'book', 'namespace' => '\Book'], function () {
        Route::get('/create', ['as' => 'book.create', 'uses' => 'Controller@create']);
        Route::post('/create', ['as' => 'book.store', 'uses' => 'Controller@store']);
        Route::get('/update/{id?}', ['as' => 'book.edit', 'uses' => 'Controller@edit']);
        Route::post('/update/{id?}', ['as' => 'book.update', 'uses' => 'Controller@update']);
        Route::get('/show', ['as' => 'book.show', 'uses' => 'Controller@show']);
        Route::get('/evaluations/show/{book_id?}', ['as' => 'book.evaluations.show.all', 'uses' => 'Controller@showEvaluations']);
        Route::post('/upload', ['as' => 'book.upload.files', 'uses' => 'Controller@uploadFile']);

        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'book.show.all', 'uses' => 'Controller@getAllBooks']);
            Route::get('/evaluations/show/{id?}', ['as' => 'book.evaluations.show', 'uses' => 'Controller@getAllEvaluations']);
            Route::put('/change/amount/{id?}/{new_amount?}', ['as' => 'book.amount.change', 'uses' => 'Controller@changeAmount']);
            Route::delete('/remove/{id?}', ['as' => 'book.remove', 'uses' => 'Controller@destroy']);
        });
    });

    Route::group(['prefix' => 'request', 'namespace' => '\Request'], function () {
        Route::get('/show', ['as' => 'request.show', 'uses' => 'Controller@show']);
        Route::get('/info/{id?}', ['as' => 'request.info.show', 'uses' => 'Controller@index']);
        Route::get('/show/data', ['as' => 'request.show.all', 'uses' => 'Controller@getAllRequests']);

        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'request.show.all', 'uses' => 'Controller@getAllRequests']);
            Route::put('/confirm/{request_id?}', ['as' => 'request.confirm.update', 'uses' => 'Controller@confirmRequest']);
        });
    });

    /**
     *
     * need to some maintainence
     *
     */
    Route::group(['prefix' => 'offer', 'namespace' => '\Offer'], function () {
        Route::get('/create', ['as' => 'offer.create', 'uses' => 'Controller@create']);
        Route::post('/create', ['as' => 'offer.store', 'uses' => 'Controller@store']);
        Route::get('/update/{id?}', ['as' => 'offer.edit', 'uses' => 'Controller@edit']);
        Route::post('/update/{id?}', ['as' => 'offer.update', 'uses' => 'Controller@update']);
        Route::get('/show/', ['as' => 'offer.show', 'uses' => 'Controller@show']);

        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'offer.show.all', 'uses' => 'Controller@getAllOffers']);
            Route::get('/book/add/offer/{offer_id?}/{book_id?}/{library_id?}', ['as' => 'offer.book.add', 'uses' => 'BookController@store']);
            Route::get('/books/{libraryId?}', ['as' => 'offer.library.book', 'uses' => 'BookController@getBooks']);
            Route::get('/offered/books/{offer_id?}', ['as' => 'offered.book.show', 'uses' => 'BookController@getAllOfferedBooks']);
            Route::get('/offered/books/activate/{offer_id?}/{library_id?}', ['as' => 'offered.book.activate', 'uses' => 'Controller@activateForAllLibraryBooks']);
            Route::delete('/offered/books/delete/{offer_id?}/{offeredBookId?}', ['as' => 'offered.book.delete', 'uses' => 'BookController@delete']);
            Route::delete('/delete/{id?}', ['as' => 'offer.delete', 'uses' => 'Controller@delete']);
        });
    });

    /**
     *
     *
     * Advertisement Routes
     *
     */
    Route::group(['prefix' => 'ads', 'namespace' => '\Advertisements'], function () {
        Route::get('/create', ['as' => 'ads.create', 'uses' => 'Controller@create']);
        Route::post('/create', ['as' => 'ads.store', 'uses' => 'Controller@store']);
        Route::get('/update/{id?}', ['as' => 'ads.edit', 'uses' => 'Controller@edit']);
        Route::post('/update/{id?}', ['as' => 'ads.update', 'uses' => 'Controller@update']);
        Route::get('/show/', ['as' => 'ads.show', 'uses' => 'Controller@display']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'ads.show.all', 'uses' => 'Controller@getAllAds']);
            Route::delete('/delete/{adsId?}', ['as' => 'ads.delete', 'uses' => 'Controller@delete']);
        });
    });


    Route::group(['prefix' => 'notification', 'namespace' => '\Notifications'], function () {
        Route::get('/show', ['as' => 'notification.show', 'uses' => 'Controller@show']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show', ['as' => 'notification.show.all', 'uses' => 'Controller@getAllNotifications']);
            Route::get('/show/type/data/{type?}', ['as' => 'notification.type.show', 'uses' => 'Controller@getTypeData']);
            Route::post('/store', ['as' => 'notification.store', 'uses' => 'Controller@store']);
            Route::get('/re/send/{id?}', ['as' => 'notification.reSend', 'uses' => 'Controller@reSend']);
            Route::delete('/delete/{id?}', ['as' => 'notification.delete', 'uses' => 'Controller@delete']);
        });
    });

    Route::group(['prefix' => 'setting', 'namespace' => '\Settings'], function () {
        Route::get('/create', ['as' => 'setting.create', 'uses' => 'Controller@create']);
        Route::post('/create', ['as' => 'setting.store', 'uses' => 'Controller@store']);
        Route::group(['prefix' => 'ajax/promocode'], function () {
            Route::get('/show', ['as' => 'promocode.show.all', 'uses' => 'PromoCodeController@getAllPromoCodes']);
            Route::post('/create', ['as' => 'promocode.store', 'uses' => 'PromoCodeController@store']);
            Route::delete('/delete/{id?}', ['as' => 'promocode.delete', 'uses' => 'PromoCodeController@delete']);
        });
    });

    Route::group(['prefix' => 'user', 'namespace' => '\User'], function () {
        Route::get('/profile/{id?}', ['as' => 'user.profile', 'uses' => 'Controller@show']);
        Route::group(['prefix' => 'ajax'], function () {
            Route::get('/show/requests/{id?}', ['as' => 'user.requests.show.all', 'uses' => 'Controller@getAllRequests']);
        });
    });
    Route::get('/logout', ['as' => 'logout', 'uses' => 'Login\Controller@logout']);


});

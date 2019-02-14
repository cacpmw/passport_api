<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1'], function () {

    //OPEN ROUTES
    Route::group(['prefix' => 'auth'], function () {

        Route::post('register', 'Api\V1\Auth\RegisterController@register')->name('register');//this one is meant to be closed before going to production
        Route::post('login', 'Api\V1\Auth\LoginController@login')->name('login');
        Route::get('logout', 'Api\V1\Auth\LoginController@logout')->middleware(['auth:api'])->name('logout');
    });
    //CLOSED ROUTES
    Route::middleware(['auth:api'])->group(function () {
        Route::group(['prefix' => 'self', 'middleware' => 'scope:self'], function () {
            Route::get('me', 'Api\V1\Self\UserController@show')->name('self.user.show');

        });
    });
});

<?php

use Illuminate\Http\Request;

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
Route::group(['prefix'=>'user'], function () {
//    Route::post('login', 'LoginController@login')->name('login');
//    Route::post('register', 'RegisterController@register')->name('register');
    Auth::routes(['verify' => true]);
});

Route::group([
//    'middleware' => 'auth:api',
    'namespace'=>'API'], function () {
    Route::post('details', 'UserController@details');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('instagram','Instagram\InstagramController');
});



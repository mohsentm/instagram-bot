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
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::group(['middleware' => 'auth:api','namespace'=>'API'], function () {
    Route::post('details', 'UserController@details');

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('instagram','Instagram\InstagramController');
});



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

Route::group(['middleware' => 'throttle:30,1', 'namespace' => 'Api', 'as' => 'api.'], static function () {

    Route::post('cart/add/{product}', 'CartController@add')->name('cart.add')->where('product', '[0-9]+');
    Route::post('cart/remove/{product}', 'CartController@remove')->name('cart.remove')->where('product', '[0-9]+');
});

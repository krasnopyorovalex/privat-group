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

Route::pattern('alias', '[\da-z-]+');

Auth::routes();

Route::post('send-cost', 'FormHandlerController@cost')->name('send.cost');
Route::post('send-booking', 'FormHandlerController@booking')->name('send.booking');
Route::post('send-guestbook', 'FormHandlerController@guestbook')->name('send.guestbook');
Route::get('sitemap.xml', 'SitemapController@xml')->name('sitemap.xml');

Route::group(['middleware' => ['redirector', 'shortcode']], function () {
    Route::get('{alias}', 'ServiceController@show')->name('service.show');
    Route::get('/{alias?}/{page?}', 'PageController@show')->name('page.show')->where('page', '[0-9]+');
    Route::get('blog/{alias}', 'BlogController@show')->name('article.show');
    Route::get('our-services/{alias}', 'BlogController@show')->name('our_service.show');
});

Route::group(['prefix' => '_root', 'middleware' => 'auth', 'namespace' => 'Admin', 'as' => 'admin.'], function () {

    Route::get('', 'HomeController@home')->name('home');

    Route::post('upload-ckeditor', 'CkeditorController@upload')->name('upload-ckeditor');

    foreach (glob(app_path('Domain/**/routes.php')) as $item) {
        require $item;
    }
});

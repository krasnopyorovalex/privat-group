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

Route::post('send-subscribe', 'FormHandlerController@subscribe')->name('send.subscribe');
Route::post('send-order', 'FormHandlerController@order')->name('send.order');
Route::post('send-question', 'FormHandlerController@question')->name('send.question');
Route::get('sitemap.xml', 'SitemapController@xml')->name('sitemap.xml');

Route::group(['middleware' => ['redirector', 'shortcode']], static function () {
    Route::get('{alias}', 'ServiceController@show')->name('service.show');
    Route::get('/{alias?}/{page?}', 'PageController@show')->name('page.show')->where('page', '[0-9]+');
    Route::get('articles/{alias}', 'BlogController@show')->name('article.show');
    Route::get('news/{alias}', 'InfoController@show')->name('info.show');
    Route::get('catalog/{alias}', 'CatalogController@show')->name('catalog.show');
    Route::get('projects/{alias}', 'ProjectController@show')->name('project.show');
    Route::get('product/{alias}', 'CatalogProductController@show')->name('catalog_product.show');
});

Route::group(['prefix' => '_root', 'middleware' => 'auth', 'namespace' => 'Admin', 'as' => 'admin.'], static function () {

    Route::get('', 'HomeController@home')->name('home');

    Route::post('upload-ckeditor', 'CkeditorController@upload')->name('upload-ckeditor');

    foreach (glob(app_path('Domain/**/routes.php')) as $item) {
        require $item;
    }
});

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

//Route::post('send-subscribe', 'FormHandlerController@subscribe')->name('send.subscribe');
//Route::post('send-order', 'FormHandlerController@order')->name('send.order');
//Route::post('send-callback', 'FormHandlerController@callback')->name('send.callback');
//Route::post('send-callback-popup', 'FormHandlerController@callbackPopup')->name('send.callback-popup');
//Route::post('send-order-service', 'FormHandlerController@orderService')->name('send.order_service');
//Route::post('send-order-service-item', 'FormHandlerController@orderServiceItem')->name('send.order_service_item');
Route::post('send-order-product', 'FormHandlerController@orderProduct')->name('send.order_product');
Route::post('send-question', 'FormHandlerController@question')->name('send.question');
//Route::post('order-cart', 'CartController@order')->name('order.cart');
Route::get('sitemap.xml', 'SitemapController@xml')->name('sitemap.xml');

//Route::get('cart', 'CartController@index')->name('cart.index');
//Route::post('cart/add/{product}', 'CartController@add')->name('cart.add')->where('product', '[0-9]+');
//Route::post('cart/remove/{product}', 'CartController@remove')->name('cart.remove')->where('product', '[0-9]+');
//Route::post('cart/update/{product}/{quantity}', 'CartController@update')->name('cart.update')->where('product', '[0-9]+')->where(['quantity', '[0-9]+' ]);

Route::group(['middleware' => ['redirector', 'shortcode']], static function () {
    Route::get('{alias}', 'ServiceController@show')->name('our_service_item.show');
    Route::get('/{alias?}/{page?}', 'PageController@show')->name('page.show')->where('page', '[0-9]+');
    Route::get('articles/{alias}', 'BlogController@show')->name('article.show');
    Route::get('news/{alias}', 'InfoController@show')->name('info.show');
    Route::get('catalog/{alias}', 'CatalogController@show')->name('catalog.show');
//    Route::get('projects/{alias}', 'ProjectController@show')->name('project.show');
    Route::get('product/{alias}', 'CatalogProductController@show')->name('catalog_product.show');
    Route::get('city/{alias}', 'CityController@show')->name('city.show');
});

Route::group(['prefix' => '_root', 'middleware' => 'auth', 'namespace' => 'Admin', 'as' => 'admin.'], static function () {

    Route::get('', 'HomeController@home')->name('home');

    Route::post('upload-ckeditor', 'CkeditorController@upload')->name('upload-ckeditor');

    foreach (glob(app_path('Domain/**/routes.php')) as $item) {
        require $item;
    }
});

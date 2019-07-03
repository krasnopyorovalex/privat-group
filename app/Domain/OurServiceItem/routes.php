<?php

Route::group(['prefix' => 'our-service-items', 'as' => 'our_service_items.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('our_service', '[0-9]+');

    Route::get('{our_service}', 'OurServiceItemController@index')->name('index');
    Route::get('create/{our_service}', 'OurServiceItemController@create')->name('create');
    Route::post('', 'OurServiceItemController@store')->name('store');
    Route::get('{id}/edit', 'OurServiceItemController@edit')->name('edit');
    Route::put('{id}', 'OurServiceItemController@update')->name('update');
    Route::delete('{id}', 'OurServiceItemController@destroy')->name('destroy');

});

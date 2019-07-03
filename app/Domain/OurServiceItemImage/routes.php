<?php

Route::group(['prefix' => 'our-service-item-images', 'as' => 'our_service_item_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('our_service_item', '[0-9]+');

    Route::get('{our_service_item}', 'OurServiceItemImageController@index')->name('index');
    Route::post('{our_service_item}', 'OurServiceItemImageController@store')->name('store');
    Route::get('{id}/edit', 'OurServiceItemImageController@edit')->name('edit');
    Route::put('{id}', 'OurServiceItemImageController@update')->name('update');
    Route::delete('{id}', 'OurServiceItemImageController@destroy')->name('destroy');

    Route::post('update-positions', 'OurServiceItemImageController@updatePositions')->name('update_positions');
});

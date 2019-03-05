<?php

Route::group(['prefix' => 'our_services', 'as' => 'our_services.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'OurServiceController@index')->name('index');
    Route::get('create', 'OurServiceController@create')->name('create');
    Route::post('', 'OurServiceController@store')->name('store');
    Route::get('{id}/edit', 'OurServiceController@edit')->name('edit');
    Route::put('{id}', 'OurServiceController@update')->name('update');
    Route::delete('{id}', 'OurServiceController@destroy')->name('destroy');

});

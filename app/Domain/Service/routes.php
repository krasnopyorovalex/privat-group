<?php

Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'ServiceController@index')->name('index');
    Route::get('create', 'ServiceController@create')->name('create');
    Route::post('', 'ServiceController@store')->name('store');
    Route::get('{id}/edit', 'ServiceController@edit')->name('edit');
    Route::put('{id}', 'ServiceController@update')->name('update');
    Route::delete('{id}', 'ServiceController@destroy')->name('destroy');

});
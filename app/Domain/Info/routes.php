<?php

Route::group(['prefix' => 'infos', 'as' => 'infos.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'InfoController@index')->name('index');
    Route::get('create', 'InfoController@create')->name('create');
    Route::post('', 'InfoController@store')->name('store');
    Route::get('{id}/edit', 'InfoController@edit')->name('edit');
    Route::put('{id}', 'InfoController@update')->name('update');
    Route::delete('{id}', 'InfoController@destroy')->name('destroy');

});

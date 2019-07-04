<?php

Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'ProjectController@index')->name('index');
    Route::get('create', 'ProjectController@create')->name('create');
    Route::post('', 'ProjectController@store')->name('store');
    Route::get('{id}/edit', 'ProjectController@edit')->name('edit');
    Route::put('{id}', 'ProjectController@update')->name('update');
    Route::delete('{id}', 'ProjectController@destroy')->name('destroy');

});

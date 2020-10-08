<?php

Route::group(['prefix' => 'project-images', 'as' => 'project_images.'], static function () {
    Route::pattern('id', '[0-9]+');
    Route::pattern('project', '[0-9]+');

    Route::get('{project}', 'ProjectImageController@index')->name('index');
    Route::post('{project}', 'ProjectImageController@store')->name('store');
    Route::get('{id}/edit', 'ProjectImageController@edit')->name('edit');
    Route::put('{id}', 'ProjectImageController@update')->name('update');
    Route::delete('{id}', 'ProjectImageController@destroy')->name('destroy');

    Route::post('update-positions', 'ProjectImageController@updatePositions')->name('update_positions');
});

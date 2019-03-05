<?php

Route::group(['prefix' => 'tabs', 'as' => 'tabs.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'TabController@index')->name('index');
    Route::get('create', 'TabController@create')->name('create');
    Route::post('', 'TabController@store')->name('store');
    Route::get('{id}/edit', 'TabController@edit')->name('edit');
    Route::put('{id}', 'TabController@update')->name('update');
    Route::delete('{id}', 'TabController@destroy')->name('destroy');
});
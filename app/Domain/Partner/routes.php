<?php

Route::group(['prefix' => 'partners', 'as' => 'partners.'], function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'PartnerController@index')->name('index');
    Route::get('create', 'PartnerController@create')->name('create');
    Route::post('', 'PartnerController@store')->name('store');
    Route::get('{id}/edit', 'PartnerController@edit')->name('edit');
    Route::put('{id}', 'PartnerController@update')->name('update');
    Route::delete('{id}', 'PartnerController@destroy')->name('destroy');

});
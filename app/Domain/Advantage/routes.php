<?php

Route::group(['prefix' => 'advantages', 'as' => 'advantages.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'AdvantageController@index')->name('index');
    Route::get('create', 'AdvantageController@create')->name('create');
    Route::post('', 'AdvantageController@store')->name('store');
    Route::get('{id}/edit', 'AdvantageController@edit')->name('edit');
    Route::put('{id}', 'AdvantageController@update')->name('update');
    Route::delete('{id}', 'AdvantageController@destroy')->name('destroy');

});

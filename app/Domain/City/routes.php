<?php
Route::group(['prefix' => 'cities', 'as' => 'cities.'], static function () {
    Route::pattern('id', '[0-9]+');

    Route::get('', 'CityController@index')->name('index');
    Route::get('create', 'CityController@create')->name('create');
    Route::post('', 'CityController@store')->name('store');
    Route::get('{id}/edit', 'CityController@edit')->name('edit');
    Route::put('{id}', 'CityController@update')->name('update');
    Route::delete('{id}', 'CityController@destroy')->name('destroy');
});

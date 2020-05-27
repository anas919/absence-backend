<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/prof/'], function () {

        Route::get('list', 'ProfController@index')
            ->name('prof')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'ProfController@create')
            ->name('prof_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'ProfController@store')
            ->name('prof_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'ProfController@destroy')
            ->name('prof_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'ProfController@show')
            ->name('prof_show')
            ->middleware('Admin:Prof')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'ProfController@edit')
            ->name('prof_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ProfController@update')
            ->name('prof_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
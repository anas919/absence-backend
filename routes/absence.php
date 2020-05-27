<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/absence/'], function () {

        Route::get('list', 'AbsenceController@index')
            ->name('absence')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'AbsenceController@create')
            ->name('absence_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'AbsenceController@store')
            ->name('absence_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'AbsenceController@destroy')
            ->name('absence_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'AbsenceController@show')
            ->name('absence_show')
            ->middleware('Admin:Absence')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'AbsenceController@edit')
            ->name('absence_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'AbsenceController@update')
            ->name('absence_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/seance/'], function () {

        Route::get('list', 'SeanceController@index')
            ->name('seance')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'SeanceController@create')
            ->name('seance_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'SeanceController@store')
            ->name('seance_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'SeanceController@destroy')
            ->name('seance_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'SeanceController@show')
            ->name('seance_show')
            ->middleware('Admin:Seance')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'SeanceController@edit')
            ->name('seance_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'SeanceController@update')
            ->name('seance_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
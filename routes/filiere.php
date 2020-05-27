<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/filiere/'], function () {

        Route::get('list', 'FiliereController@index')
            ->name('filiere')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'FiliereController@create')
            ->name('filiere_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'FiliereController@store')
            ->name('filiere_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'FiliereController@destroy')
            ->name('filiere_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'FiliereController@show')
            ->name('filiere_show')
            ->middleware('Admin:Filiere')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'FiliereController@edit')
            ->name('filiere_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'FiliereController@update')
            ->name('filiere_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
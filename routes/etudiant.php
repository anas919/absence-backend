<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/etudiant/'], function () {

        Route::get('list', 'EtudiantController@index')
            ->name('etudiant')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'EtudiantController@create')
            ->name('etudiant_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'EtudiantController@store')
            ->name('etudiant_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'EtudiantController@destroy')
            ->name('etudiant_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'EtudiantController@show')
            ->name('etudiant_show')
            ->middleware('Admin:Etudiant')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'EtudiantController@edit')
            ->name('etudiant_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'EtudiantController@update')
            ->name('etudiant_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
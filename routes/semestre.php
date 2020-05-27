<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/semestre/'], function () {

        Route::get('list', 'SemestreController@index')
            ->name('semestre')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'SemestreController@create')
            ->name('semestre_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'SemestreController@store')
            ->name('semestre_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'SemestreController@destroy')
            ->name('semestre_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'SemestreController@show')
            ->name('semestre_show')
            ->middleware('Admin:Semestre')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'SemestreController@edit')
            ->name('semestre_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'SemestreController@update')
            ->name('semestre_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
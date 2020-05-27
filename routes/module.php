<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/module/'], function () {

        Route::get('list', 'ModuleController@index')
            ->name('module')
            ->middleware('Admin:ADMIN');
        
        Route::get('create', 'ModuleController@create')
            ->name('module_create')
            ->middleware('Admin:ADMIN');
        
        Route::post('create', 'ModuleController@store')
            ->name('module_store')
            ->middleware('Admin:ADMIN');
        
        Route::get('{id}/delete', 'ModuleController@destroy')
            ->name('module_delete')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'ModuleController@show')
            ->name('module_show')
            ->middleware('Admin:Module')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'ModuleController@edit')
            ->name('module_edit')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'ModuleController@update')
            ->name('module_update')
            ->middleware('Admin:ADMIN')
            ->where('id', '[0-9]+');
        
    });
});
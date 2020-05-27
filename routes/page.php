<?php

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'auth','prefix' => '/admin/page/'], function () {

        Route::get('list', 'PageController@index')
            ->name('page')
            ->middleware('Admin:Page');
        
        Route::get('create', 'PageController@create')
            ->name('page_create')
            ->middleware('Admin:Page');
        
        Route::post('create', 'PageController@store')
            ->name('page_store')
            ->middleware('Admin:Page');
        
        Route::get('{id}/delete', 'PageController@destroy')
            ->name('page_delete')
            ->middleware('Admin:Page')
            ->where('id', '[0-9]+');
        
        /*Route::get('{id}', 'PageController@show')
            ->name('page_show')
            ->middleware('Admin:Page')
            ->where('id', '[0-9]+');*/
        
        Route::get('{id}/edit', 'PageController@edit')
            ->name('page_edit')
            ->middleware('Admin:Page')
            ->where('id', '[0-9]+');
        
        Route::post('{id}', 'PageController@update')
            ->name('page_update')
            ->middleware('Admin:Page')
            ->where('id', '[0-9]+');
        
    });
});
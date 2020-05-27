<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('gigs', 'HomeController@gigs');
    Route::get('modules', 'ModuleController@modules');
    Route::get('seances', 'SeanceController@seances');
    Route::post('seances/add', 'SeanceController@seance_store');
    Route::post('seances/edit/{id}', 'SeanceController@seance_update');
    Route::get('seances/fetch/{id}', 'SeanceController@seance_fetch');
    Route::get('seances/students/{id}', 'SeanceController@studentsBySeance');
    Route::post('seances/students/mark', 'SeanceController@markAbsentStudents');


    Route::get('students', 'EtudiantController@students');
});
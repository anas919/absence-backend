<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'web'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('home', 'HomeController@admin')->name('home');
        Route::get('admin', 'HomeController@admin')->name('admin');
    });
});

include 'user.php';
include 'media.php';
include 'groupe.php';
include 'page.php';
include 'filiere.php';
include 'etudiant.php';
include 'prof.php';
include 'semestre.php';
include 'module.php';
include 'seance.php';
include 'absence.php';
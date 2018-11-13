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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/edu/home/index','Edu\HomeController@index')->name('edu.home.index');
Route::get('/edu/home/home','Edu\HomeController@home')->name('edu.home.home');

//Route::get('/edu/photo/index','Edu\PhotoController@index')->name('edu.photo.index');
Route::post('/edu/home/store','Edu\HomeController@store')->name('edu.home.store');
Route::resource('/edu/photo','Edu\PhotoController');
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/','Util\HomeController@index')->name('home');
Route::get('/register','Util\UserController@register')->name('register');
Route::post('/register','Util\UserController@store')->name('register');
Route::any('/code/send','Util\CodeController@send')->name('code.send');
Route::get('/login','Util\UserController@login')->name('login');
Route::post('/login','Util\UserController@loginForm')->name('login');
Route::get('/logout','Util\UserController@logout')->name('logout');
Route::get('/password_reset','Util\UserController@passwordReset')->name('password_reset');
Route::post('/password_reset','Util\UserController@passwordRestForm')->name('password_reset');

//后台路由
Route::group(['middleware' => ['admin.auth'],'prefix'=>'admin','namespace'=>'Admin','as'=>'admin.'],function(){
    Route::get('index','IndexController@index')->name('index');

    Route::resource('category','CategoryController');
});

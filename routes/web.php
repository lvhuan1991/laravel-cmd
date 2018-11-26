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
Route::any('/code/send','Util\CodeController@send')->name('code.send');//发送验证码
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
//网站首页
Route::get('/','Home\HomeController@index')->name('home');//网站首页
//前台
Route::group(['prefix'=>'home','namespace'=>'Home','as'=>'home.'],function(){
    Route::get('/','HomeController@index')->name('index');
    Route::resource('article','ArticleController');//文章管理
    Route::resource('comment','CommentController');//评论
});
//工具类
Route::group(['prefix'=>'util','namespace'=>'Util','as'=>'util.'],function(){
    //上传
    Route::any('/upload','UploadController@uploader')->name('upload');
    Route::any('/filesLists','UploadController@filesLists')->name('filesLists');

});
//会员中心
Route::group(['prefix'=>'member','namespace'=>'Member','as'=>'member.'],function(){
    Route::resource('user','UserController');//用户管理
    //👇定义关注取消关注；这个方法不是在资源resource路由里面的方法，是自己创的 所以手动加上参数
    Route::get('attention/{user}','UserController@attention')->name('attention');//定义关注取消关注
    //我的粉丝
    Route::get('get_fans/{user}','UserController@myFans')->name('my_fans');
    Route::get('get_following/{user}','UserController@myFollowing')->name('my_following');
});


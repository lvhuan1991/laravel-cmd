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
//用户管理
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
    //配置项管理
    Route::get('config/edit/{name}','ConfigController@edit')->name('config.edit');
    Route::post('config/update/{name}','ConfigController@update')->name('config.update');
});
//网站首页
Route::get('/','Home\HomeController@index')->name('home');//网站首页
//前台
Route::group(['prefix'=>'home','namespace'=>'Home','as'=>'home.'],function(){
    Route::get('/','HomeController@index')->name('index');
    Route::resource('article','ArticleController');//文章管理
    Route::resource('comment','CommentController');//评论
    Route::get('zan/make','ZanController@make')->name('zan.make');//点赞  取消赞
    Route::get('collect/make','CollectController@make')->name('collect.make');//收藏  取消收藏
    //搜索
    Route::get('search','HomeController@search')->name('search');
});
//轮播图管理
Route::group(['prefix'=>'swiper','namespace'=>'Swiper','as'=>'swiper.'],function(){
   //图片管理
    Route::resource('swiper','SwiperController');
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
    //我的关注
    Route::get('get_following/{user}','UserController@myFollowing')->name('my_following');
    //我的收藏
    Route::get('get_collect/{user}','UserController@myCollect')->name('my_collect');
    //我的点赞
    Route::get('get_zan/{user}','UserController@myZan')->name('my_zan');//我的点赞
    //我的所有通知
    Route::get('notify/{user}','NotifyController@index')->name('notify');
    //标记已读
    Route::get('notify/show/{notify}','NotifyController@show')->name('notify.show');
});
//微信管理
Route::group(['prefix'=>'wechat','namespace'=>'Wechat','as'=>'wechat.'],function(){
    //菜单管理
    Route::resource('button','ButtonController');
    Route::get('button/push/{button}','ButtonController@push')->name('button.push');
    //微信通信地址(因为微信提交时post方式)
    Route::any('api/handler','ApiController@handler')->name('api.handler');
    //基本文本回复
    Route::resource('response_text','ResponseTextController');
    //图文回复
    Route::resource('response_news','ResponseNewsController');
    //基本回复  关注回复以及默认回复
    Route::resource('response_base','ResponseBaseController');
});
//权限管理
Route::group(['prefix'=>'role','namespace'=>'Role','as'=>'role.'],function(){
    //权限列表
    Route::get('permission/index','PermissionController@index')->name('permission.index');
    //清除权限缓存
    Route::get('permission/forget_permission_cache','PermissionController@forgetPermissionCache')->name('permission.forget_permission_cache');
    //角色管理的资源路由
    Route::resource('role','RoleController');
    //设置角色权限(因为上面的资源路由不包含新创建的方法所以得再创一个路由,因为只有资源路由自己带参数所以下面的得带参数)
    Route::post('role/set_role_permission/{role}','RoleController@setRolePermission')->name('role.set_role_permission');
    //用户管理
    Route::get('user/index','UserController@index')->name('user.index');
    Route::get('user/user_set_role_create/{user}','UserController@userSetRoleCreate')->name('user.user_set_role_create');
    Route::post('user/user_set_role_store/{user}','UserController@userSetRoleStore')->name('user.user_set_role_store');
});

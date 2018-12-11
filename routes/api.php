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

Route::middleware('auth:api')->get('/user',function(Request $request){
    return $request->user();
});

//创建路由👇
$api = app(\Dingo\Api\Routing\Router::class);
#默认配置指定的是v1版本，可以直接通过 {host}/api/version 访问到
//$api->version('v1',function($api){
//    $api->get('version',function(){
//        return 'v1';
//    });
//});
//$api->version({
//});
$api->version('v1',['namespace' => '\App\Http\Controllers\Api'],function($api){
    //$api->get('version',function(){
        //return 'v1';
    //});
    //获取文章数据
    $api->get('articles','ArticleController@articles');
    $api->get('show/{id}','ArticleController@show');
    //获取栏目数据
    $api->get('categories','CategoryController@categories');
    //获取轮播图数据
    $api->get('swipers', 'SwiperController@swipers');
    //登录请求
    $api->post('login','AuthController@login');
    //我的
    $api->get('me','AuthController@me');
    //退出
    $api->get('logout','AuthController@logout');

});

#如果v2不不是默认版本，需要设置请求头
#Accept: application/[配置项 standardsTree].[配置项 subtype].v2+json
#Accept: application/prs.article.v2+json
//$api->version('v2', function ($api) {
//    $api->get('version', function () {
//        return 'v2';
//    });
//});

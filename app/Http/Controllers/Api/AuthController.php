<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends CommonController
{
    public function __construct(){
        $this->middleware('auth:api',['except'=>['login']]);
        //除了登录以外都需要验证
    }

    public function login(){
        //dd(\request()->only(['email','password']));
        if (!$token = auth('api')->attempt(request()->only(['email', 'password']))) {
            //登录失败
            return $this->response->errorUnauthorized('帐号或密码错误');
        }
        //登录成功
        return $this->respondWithToken($token);
    }
    //响应token
    protected function respondWithToken($token){
        //获取 jwt.php 配置文件中 token 有效期 60
        //dd(auth('api')->factory()->getTTL());//打印60
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }
    //获取用户资料
    public function me(){
        return response()->json(auth('api')->user());
    }
    //注销登录
    public function logout(){
        //注意这个auth和response都不能按提示  都是函数方法
        auth('api')->logout();
        return response()->json(['message'=>'Successfully loggde out']);
    }
}

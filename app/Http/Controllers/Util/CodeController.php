<?php

namespace App\Http\Controllers\Util;

use App\Notifications\Notification\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
    //随机获取4位数字验证码
    public function random($length=4){
        $str = '';
        for($i=0;$i<$length;$i++){
            $str .=mt_rand(0,9);
        }
        return $str;
    }
    //发送验证码
    public function send(Request $request){
        //获得所有请求数据
        //dd($request->all());

//        lvhuan1991@qq.com
        //消息通知
//        [env 文件邮件的配置]
//            [创建通知类 artisan make:notification ]
//        $user->notify(new InvoicePaid($invoice));

        $code = $this->random();//随机四位验证码
        //发送验证码（手册：消息通知）
        $user = User::firstOrNew(['email'=>$request->username]);
        //dd($user);怎么没打印出来???????
        //需要创建通知类:php artisan make:notification(RegisterNotify)
        //由默认App\User模型使用，并包含一个可用于发送通知的notify方法。notify方法期望接收通知实例
        $user->notify(new RegisterNotify($code));
        session()->put('code',$code);//将验证码存入到session中
        return ['code' => 1, 'message' => '验证码发送成功'];//返回数据

    }
}

<?php

namespace App\Http\Controllers\Util;

use App\Notifications\Notification\RegisterNotify;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CodeController extends Controller
{
//    public function iphone($code,$iphone)
//    {
//
//        $smsapi = "http://api.smsbao.com/";
//        $user = "lvhuan1991"; //短信平台帐号
//        $pass = md5("lh136268"); //短信平台密码
//        $content = "【MR】你好欢迎您注册梦里网，你的验证码是$code";//要发送的短信内容
//        $phone = "$iphone";//要发送短信的手机号码
//        $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
//        $result = file_get_contents($sendurl);
//
//
//    }

    //随机获取4位数字验证码
    public function random($length = 4)
    {
        $str = '';
        for($i = 0;$i<$length;$i++){
            $str .= mt_rand(0,9);
        }
        return $str;
    }

    //发送验证码
    public function send(Request $request)
    {
        //获得所有请求数据
        //dd($request->all());

        //        lvhuan1991@qq.com
        //消息通知
        //        [env 文件邮件的配置]
        //            [创建通知类 artisan make:notification ]
        //        $user->notify(new InvoicePaid($invoice));

        $code = $this->random();//随机四位验证码
        //        $this->iphone($code,$request->username);手机验证的
        //发送验证码（手册：消息通知）
        $user = User::firstOrNew(['email' => $request->username]);
        //dd($user);怎么没打印出来???????
        //需要创建通知类:php artisan make:notification(RegisterNotify)
        //由默认App\User模型使用，并包含一个可用于发送通知的notify方法。notify方法期望接收通知实例
        $user->notify(new RegisterNotify($code));
        session()->put('code',$code);//将验证码存入到session中
        return ['code' => 1,'message' => '验证码发送成功'];//返回数据

    }
}

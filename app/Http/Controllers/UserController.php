<?php

namespace App\Http\Controllers\Util;

use App\Http\Requests\PasswordResetRequst;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(){
        //调用中间件，保护登录注册（已经登录用户不允许再访问登录注册）
        $this->middleware('guest',[
            'only'=>['login','loginForm','register','store','passwordReset','passwordResetForm'],
        ]);
    }

    //加载注册页面(get)
    public function register(){
        return view('user.register');//渲染注册页面
    }
    //用户提交注册(post)
    public function store(RegisterRequest $request){
        //dd($request->all());
        //将数据存储到数据表
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        //提示并且跳转
        return redirect()->route('login')->with('success','注册成功');
    }
    //加载登录页面(get)
    public function login(){
        return view('user.login');
    }
    //登录提交（post）
    public function loginForm(Request $request){
        //东西不多判断就不分类写了直接写在下面
        //$this->validate();验证
        $this->validate($request,[
            'email'=>'email',
            'password'=>'min:3',
        ],[
            'email.email'=>'请输入正确邮箱',
            'password.required'=>'请输入密码',
            'password.min'=>'密码不得少于3位',
        ]);
        //验证完了后执行登录👉手册：用户认证
        $credentials = $request->only('email', 'password');
        if (\Auth::attempt($credentials,$request->remember)) {
            // Authentication passed...
            //登录成功，跳转到首页
            return redirect()->route('home')->with('success','登录成功');
        }
        return redirect()->back()->with('danger','用户名密码不正确');
    }
    //退出登录
    public function logout(){
        \Auth::logout();
        return redirect()->route('home');
    }
    //重置密码
    public function passwordReset(){
        return view('user.password_reset');
    }
    //新密码提交
    public function passwordRestForm(PasswordResetRequst $requst){
        //根据用户提交来的邮箱去查找数据
        $user = User::where('email',$requst->email)->first();
        if($user){
            //更新密码
            $user->password = bcrypt($requst->password);
            $user->save();
            return redirect()->route('login')->with('success','密码重置成功');
        }
        return redirect()->back()->with('danger','该邮箱未注册');
    }
}

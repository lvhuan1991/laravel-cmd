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
        //dd($request->all());
        //验证
        //dd(1);
        $this->validate($request,[
            'email'=>'email',
            'password'=>'required|min:3'
        ],[
            'email.email'=>'请输入邮箱',
            'password.required'=>'请输入登录密码',
            'password.min'=>'密码不得少于3位置'
        ]);
        //dd(2);
        //执行登录
        //手册：用户认证
        $credentials = $request->only('email', 'password');
        if(\Auth::attempt($credentials,$request->remember)){
            //return redirect()->route('home')->with('success','登录成功');//登录成功，跳转到首页
            //加个判断，省的老是忘首页跳转，因该是在哪个页面登录然后跳转到哪个页面去的
            if($request->from){
                return redirect($request->from)->with('success','登录成功');
            };
            return redirect('/')->with('success','登录成功');
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
        //根据用户提交来的邮箱去查找数据(first就是只有一个数组即一条数据,可以打印看到)
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

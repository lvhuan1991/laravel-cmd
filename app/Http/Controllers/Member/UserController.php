<?php

namespace App\Http\Controllers\Member;

use App\Models\Article;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //dd($user);
        //获取当前用户发表的文章
        $articles = Article::latest()->where('user_id',$user->id)->paginate(10);
        return view('member.user.show',compact('user','articles'));
    }

    public function edit(User $user,Request $request)
    {
        //调用策略
        $this->authorize('isMine','$user');
        //第一个参数是指策略类中的方法，第二个是权限服务提供类中AuthServiceProvider类中的User::class => UserPolicy::class
        //接受type参数👇(先得传形参,不然之间调用不了的)
        $type = $request->query('type');
        return view('member.user.edit_'.$type,compact('user'));
    }

    public function update(Request $request, User $user)
    {
        //这里用的是系统内置的Request类，而不是我们自己创的！
        $data = $request->all();
        $this->authorize('isMine','$user');//调用策略
        $this->validate($request,[
            'password' =>'sometimes|required|min:3|confirmed',
            'name'=>'sometimes|required',
        ],[
            'password.required'=>'请输入密码',
            'password.min'=>'密码不得小于3位',
            'password.confirmed'=>'两次密码不一致',
            'name.required'=>'请输入昵称'
        ]);
        if($request->password){
            $data['password'] = bcrypt($data['password']);//加密密码
        }
        $user->update($data);//执行更新
        return back()->with('success','操作成功');
    }

    public function destroy(User $user)
    {
        //
    }
}

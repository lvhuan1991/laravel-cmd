<?php

namespace App\Http\Controllers\Role;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //展示所有用户
    public function index(){
        //获取所有用户
        $users = User::paginate(10);
        //dd($users->toArray());
        return view('role.user.index',compact('users'));
    }
    //展示用户设置角色模板
    public function userSetRoleCreate(User $user){
        //获取所有角色
        $roles = Role::all();
        //dd($roles->toArray());
        return view('role.user.set_role',compact('roles','user'));
    }
    //给 用户设置角色
    public function UserSetRoleStore(User $user,Request $request){
        //dd($request->all());
        //dd($user);
        //dd($user->toArray());
        //查看手册doc文档里面设置权限小结和参考DyModule.php
        $user->syncRoles($request->roles);//这个给用户是设置角色
        //$role->syncPermissions($request->permission);//给角色设置权限
        return back()->with('success','设置成功');
    }
}

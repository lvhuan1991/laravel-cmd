<?php

namespace App\Http\Controllers\Role;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //获取权限列表
    public function index(){
        //获取所有模块表 modules 数据
        $modules = Module::all();
        //dump($modules->toArray());
        return view('role.permission.index',compact('modules'));
    }
    //清除权限缓存
    public function forgetPermissionCache(){
        app()['cache']->forget('spatie.permission.cache');
        return back()->with('success','缓存清除成功');
    }
}

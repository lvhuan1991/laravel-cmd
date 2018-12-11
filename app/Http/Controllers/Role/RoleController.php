<?php

namespace App\Http\Controllers\Role;

use App\Models\Module;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct(){
        $this->middleware('admin.auth',['except'=>[]]);
    }

    public function index()
    {
        //获取所有角色
        $roles = Role::paginate(10);
        //dd($roles);
        return view('role.role.index',compact('roles'));
    }

    public function create()
    {

        return view('role.role.create');
    }

    public function store(Request $request,Role $role)
    {
        //dd($request->all());
//        $role['title'] = $request['title'];
//        $role['name'] = $request['name'];
//        $role->save();
        Role::create($request->all());
        return redirect()->route('role.role.index')->with('success','添加成功');
    }

    public function edit(Role $role)
    {
        //dd($role);
        return view('role.role.edit',compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        //dd($request->all());
//        $role->title = $request->title;
//        $role->name = $request->name;
//        $role->update();
        $role->update($request->all());
        return redirect()->route('role.role.index')->with('success','更新成功');
    }

    public function destroy(Role $role)
    {
        //dd($role);
        $role->delete();
        return back()->with('success','okok');
    }
    //这里为了不创建一个单独的路由来控制，就直接用这里的show方法了还有下面创建的一个方法
    //展示角色设置权限的模板页面
    public function show(Role $role)
    {
        //获取所有模块以及权限,获取的 modules 所有数据
        $modules = Module::all();
        //dump($modules->toArray());
        return view('role.role.set_permission',compact('role','modules'));
    }
    //设置角色权限
    public function setRolePermission(Role $role,Request $request){
        //给角色设置权限
        //dd($request->all());
        $role->syncPermissions($request->permissions);
        return back()->with('success', '操作成功');
    }

}

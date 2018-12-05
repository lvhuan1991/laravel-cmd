<?php

namespace App\Http\Controllers\Admin;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function edit($name)
    {
        //dd($name);//打印出来的是base
        $config = Config::firstOrNew(['name' => $name]);//firstOrNew手册位置: Eloquent ORM-->快读入门
        //dd($config);
        //dd($config['data']);
        return view('admin.config.edit_'.$name,compact('config','name'));
    }

    public function update($name,Request $request)
    {
        $res = Config::updateOrCreate(
            ['name' => $name],
            ['name' => $name,'data' => $request->all()]
        );
        hd_edit_env($request->all());//只会更新env文件中有的配置项第三方的函数
        return back()->with('success','配置项更新成功');
    }
}

<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    //1.首先能正常上传图片
    //2.将上传文件正常写入数据表
    //3.文件列表方法filesLists
    //4.用异常类处理上传
    public function uploader(Request $request)
    {
        //dd(1);//打印测试，看上传之后代码是否执行到这里
        //dd(asset(''));//打印结果👉"http://laravel.edu/"
        //dd(storage_path(''));//打印结果👉"D:\wampee\www\PHP\laravel\storage"
        //dd(public_path());//打印结果👉"D:\wampee\www\PHP\laravel\public"
        //dd($_FILES);//来查看上传表单的name//打印结果👉file的一个数组
        //上传手册参考(文件存储--文件上传)：http://www.houdunren.com/edu/section/107
        //$path = $request->file('avatar')->store('avatars');
        //$path = $request->file('上传表单name名')->store('上传文件存储目录','指定磁盘(对应config/filesystem.php中disk)');
        $file = $request->file('file');
        $this->checkSize($file);//对上传文件的大小拦截
        $this->checkType($file);//对上传文件的类型拦截
        //以下这句话中第一个attachment意思上传文件存储目录
        //第二个attachment对应config/filesystem.php中disk选项中attachment
        if($file){
            $path = $file->store('attachment','attachment');
            //将上传数据存储到数据表
            //我们创建附件的模型与迁移文件
            //（一对多）关联添加hasmany;一个有很多就是一对多、很多属于一个就是多对一
            //多对一是belongsTo;多对多belongsToMany
            auth()->user()->attachment()->create([
                //$file->getClientOriginalName()获取客户端原始文件名
                'name'=>$file->getClientOriginalName(),
                'path'=>url($path),
            ]);
        }
//        dd(url($path));//为什么上面的方法没有提示?????
        return ['file' => url($path), 'code' => 0];
        //这个返回值是在看云hdjs里面的上传处理、初始配置里面、成功时给的返回值

    }
    //获取图片列表
    public function filesLists(){
        $files = auth()->user()->attachment()->paginate(8);//分页
        $data = [];
        foreach($files as $file){
            $data[] = [
                'url' => $file['path'],
                'path' => $file['path'],
            ];
        }
        //dd($data);//这个打印得在控制台看，因为是异步操作
        return [
            'data' => $data,
            'page' => $files->links() . '',//这里一定要注意分页后面拼接一个空字符串
            'code' => 0
        ];
    }
    //验证上传类型
    private function checkType($file){
        if(!in_array(strtolower($file->getClientOriginalExtension()),['jgp','png'])){
            //return  ['message' =>'类型不允许', 'code' => 403];//hdjs手册里面的
            //使用异常类处理上传异常
            //创建异常类:exception
            throw new UploadException('类型不允许');
        }
    }
    //验证上传大小
    private function checkSize($file){
        //$file->getSize()获取上传文件大小
        if($file->getSize() > 200000){
            //return  ['message' =>'上传文件过大', 'code' => 403];
            //使用异常类处理上传异常
            //创建异常类:exception
            throw new UploadException('上传文件过大');
        }
    }
















}

<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ZanController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            'only'=>'make'
        ]);
        //auth中间件对应的中间件在哪里,需要看注册中间件(app/Http/Kernal.php中$routeMiddleware)
        //article/show.blade.php模板中点赞增加 auth 判断用户是否登录
    }

    public function make(Request $request){
        $type = $request->query('type');//页面上传过来的参数
        //dd($type);//article     说明点赞的类型是文章类型
        $id = $request->query('id');//页面上传过来的参数
        //dd($id);//103   这篇文章的id是103
        //dd($request->all());打印出来type和id的相关数据
        $class = 'App\Models\\' . ucfirst($type);//根据 get 参数 type 组合模型类 class 名
        //dd($class);//App\Models\Article
        $model = $class::find($id);//App\Models\Article::find(103)
        //dd($model);打印出文章的相关信息
        //dd($model->zan->all());//空的数据
        //dd($model->zan->where('user_id',auth()->id())->first());//null
        if($zan = $model->zan->where('user_id',auth()->id())->first()){
            $zan->delete();
        }else{
            //dd($model->zan()->create());//创建的数据
            $model->zan()->create(['user_id'=>auth()->id()]);
        }
        //判断是否为异步
//        if($request->ajax()){
//            //这个需要重新获取对应模型,这句话结合异步请求
//            $newModel = $class::find($id);
//            return ['code'=>1,'message'=>'','num'=>$newModel->zan->count()];
//        }
        if($request->ajax()){
            //这个需要重新获取对应模型,这句话结合异步请求
            $newModel = $class::find($id);
            return ['code'=>1,'message'=>'','zan_num'=>$newModel->zan->count()];
        }
        return back();//返回当前页面
    }
}

<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Button;
use App\Services\WechatService;
use Houdunwang\WeChat\WeChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ButtonController extends Controller
{
    public function __construct(){
        $this->middleware('admin.auth',['except'=>[],]);
    }

    public function index()
    {
        $buttons = Button::latest()->paginate(8);//latest最近排序  分页
        //dd($buttons);
        return view('wechat.button.index',compact('buttons'));
    }

    public function create()
    {
        return view('wechat.button.create');
    }

    public function store(Request $request,Button $button)
    {
        //Button::create($request->all());//这样可以
        $button->create($request->all());
        return redirect()->route('wechat.button.index')->with('success','菜单添加成功');
    }

    public function edit(Button $button)
    {
//        dd($button);
        return view('wechat.button.edit',compact('button'));
    }

    public function update(Request $request, Button $button)
    {
        //Button::update($request->all());//这样为什么不行,是不是因为括号里面已经实例化了？
        $button->update($request->all());
        return redirect()->route('wechat.button.index')->with('success','菜单编辑成功');
    }

    public function destroy(Button $button)
    {
        $button->delete();
        return redirect()->route('wechat.button.index')->with('success','菜单删除成功');
    }
    //将微信菜单推送到公众号
    //推送菜单之前 先实例化WechatService,该类构造方法有微信通信验证
    public function push(Button $button,WechatService $wechatService){
        //将原来数据库 json 格式数据转为数组
        $menu = json_decode($button['data'],true);
        //wechat 类要求传递惨淡数据需要是数组
        $res = WeChat::instance('button')->create($menu);
//        dd($res);报错
        if($res['errcode'] == 0){
            //将当前菜单数据表 status 修改1,其余的改为0
            $button->update(['status'=>1]);
            Button::where('id','!=',$button->id)->update(['status'=>0]);
            return back()->with('success','菜单推送成功');
        }else{
            return back()->with('danger',$res['errmsg']);
        }
    }
}

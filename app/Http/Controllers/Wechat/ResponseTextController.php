<?php

namespace App\Http\Controllers\Wechat;

use App\Models\ResponseText;
use App\Services\WechatService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResponseTextController extends Controller
{
    public function __construct(){
        $this->middleware('admin.auth',['except'=>[],]);
    }

    public function index()
    {
        $field = ResponseText::all();//读取所有回复
        //dd($field);
        return view('wechat.response_text.index',compact('field'));
    }

    public function create(WechatService $wechatService)
    {
        $ruleView = $wechatService->ruleView();
        return view('wechat.response_text.create',compact('ruleView'));
    }

    public function store(Request $request,WechatService $wechatService)
    {
        //开启事务
        \DB::beginTransaction();
        //dd($request->all());
        //dd($request->data);
        $rule = $wechatService->ruleStore('text');
        //添加回复内容
        ResponseText::create([
            'content'=>$request['data'],
            'rule_id'=>$rule['id'],
        ]);
        //事务提交
        \DB::commit();
        return redirect()->route('wechat.response_text.index');
    }

    public function edit(ResponseText $responseText,WechatService $wechatService)
    {
        //dd($responseText);
        $ruleView = $wechatService->ruleView($responseText['rule_id']);
        return view('wechat.response_text.edit',compact('ruleView','responseText'));
    }

    public function update(Request $request, ResponseText $responseText,WechatService $wechatService)
    {
        //开启事务
        \DB::beginTransaction();
        //dd($responseText);
        //更新规则表和关键词表
        $wechatService->ruleUpdate($responseText['rule_id']);
        //更新回复表
        $responseText->update([
            'content'=>$request['data'],
            'rule_id'=>$responseText['rule_id'],
        ]);
        //事务提交
        \DB::commit();
        return redirect()->route('wechat.response_text.index');
    }

    public function destroy(ResponseText $responseText)
    {
        //dd($responseText);
        //$responseText->delete();//是不是因为关联了所以只要删除规则即可
        $responseText->rule()->delete();//是不是因为关联了所以只要删除规则即可
        return redirect()->route('wechat.response_text.index')->with('success','OK');
    }
}

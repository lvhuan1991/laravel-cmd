<?php

namespace App\Services;

use App\Models\Keyword;
use App\Models\Rule;
use Houdunwang\WeChat\WeChat;

class WechatService
{
        public function __construct(){
            //与微信通信绑定
            //读取 config/hd_config.php配置文件
            //config()读取框架配置项、框架配置项读取env对数据、env数据来源我们自己的后台
            $config = config('hd_wechat');//config函数是框架内置的
            //dd($config);//这个打印得在env配置项中添加微信后台设置的配置项并且在hd_wechat里面把小写改大写
            //https://www.kancloud.cn/houdunwang/wechat/322346
            WeChat::config($config);//微信配置👆
            //https://www.kancloud.cn/houdunwang/wechat/324351
            WeChat::valid();//验证消息的确来自微信服务器👆
        }
    //加载规则视图文件
    public function ruleView($rule_id = 0){
        //根据规则 id 去规则表找旧数据
        $rule = Rule::find($rule_id);
        //dd($rule);
        $ruleData = [
            'name'=>$rule?$rule['name']:'',//规则名称
            'keywords'=>$rule?$rule->keyword()->select('key')->get()->toArray():[],
        ];
        return view('wechat.layouts.rule',compact('ruleData'));
    }
    //添加数据
    public function ruleStore($type){
        //dd(request()->all());
        $post = request()->all();
        //$post = request()->rule;//这两种写法结果是一样的👇
        //$post = request()->input('rule');和上面写法结果一样👆
        //dd($post['rule']);//打印出来的都是json格式数据,需要把数据转成数组格式
        $rule = json_decode($post['rule'],true);
        //dd($rule);
        //执行规则表的添加
        \Validator::make($rule,[
            'name'=>'required'
        ],[
            'name.required'=>'规则名称不能为空'
        ])->validate();
        $ruleModel = Rule::create(['name'=>$rule['name'],'type'=>$type]);
        //dd($rule);//为什么看不到回复的内容,因为只打印了规则
        //关键词表添加
        foreach($rule['keywords'] as $value){
            Keyword::create([
                'rule_id' => $ruleModel['id'],
                'key' => $value['key']
            ]);
        }
        return $ruleModel;
    }
    public function ruleUpdate($rule_id){
        //执行规则表的编辑
        //dd($rule_id);
        $rule = Rule::find($rule_id);
        $post = request()->all();
        $ruleData = json_decode($post['rule'],true);
        $rule->update(['name'=>$ruleData['name']]);
        //关键词表编辑
            //原来的关键词删除
        $rule->keyword()->delete();
        foreach($ruleData['keywords'] as $value){
            Keyword::create([
                'rule_id'=>$rule_id,
                'key'=>$value['key']
            ]);
        }
    }
}
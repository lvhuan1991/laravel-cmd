<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Keyword;
use App\Models\ResponseBase;
use App\Models\Rule;
use App\Services\WechatService;
use Houdunwang\WeChat\WeChat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
//    这个地址可以通过路由查看来获得把这个地址改到微信公众接口的URL上面去
    //微信后台接口配置 url 填写地址指向该方法
    //调用WechatService ,这个类中构造方法进行通信验证
    public function handler(WechatService $wechatService){
        //第1步👉：协助测试 数据
//        $rule = Rule::find(10);
//        //dd($rule);
//        $responseContent = json_decode($rule->responseText->pluck('content')->toArray()[0],true);
//        //dd($responseContent);
//        $content = array_random($responseContent)['content'];
//        //dd($content);
        //第2步👉：测试获取对应图文数据
//        $rule = Rule::find(6);
//        dd(json_decode($rule->responseNews->toArray()[0]['data'],true));

        //第3步👉：消息管理模块（手册上找的看云后盾网微信👇）
        $instance =WeChat::instance('message');
        //微信给我们服务器推送消息 post 方式推送消息
        //第一点:注意路由设置请求方法 any
        //第二点:post 请求必须伴随 csrf,需要设置 csrf 白名单
        //所有微信相关用法需要参考:https://www.kancloud.cn/houdunwang/wechat/325049

//！！！！！！！！！！！微信端测试的代码不能在浏览器上打印 会报错 ！！！！！！！！！！！！！！！

        //第4步👉：判断是否是文本消息()
        if($instance->isTextMsg()){
            //第5步👉：向用户回复消息
            //return $instance->text('后盾人收到你的消息了...:' . $instance->Content);
            //获取粉丝发送来的消息内容
            $content = $instance->Content;
            //根据消息内容去关键词表查找数据
            return $this->keyWordToFindResponse($instance,$content);
        }
        //======菜单事件=======//
        //第9步👉：消息管理模块
        $buttonInstance = WeChat::instance('button');
        //第10步👉：点击菜单拉取消息时的事件推送
        if ($buttonInstance->isClickEvent()) {
            //获取消息内容
            $message = $buttonInstance->getMessage();
//            return WeChat::instance('message')->text("点击了菜单,EventKey:{$message->EventKey}");
            return $this->keyWordToFindResponse($instance,$message->EventKey);
            //向用户回复消息
            //return WeChat::instance('message')->text("点击了菜单,EventKey:{$message->EventKey}");
        }
        //====关注事件====//
        //第11步👉：判断是否是关注事件
        if($instance->isSubscribeEvent()){
            $content = ResponseBase::find(1);
            //第12步👉：向用户回复消息
            return $instance->text($content['data']['subscribe']);
        }
    }
    //根据关键词回复内容
    private function keyWordToFindResponse($instance,$content){
        if($keyword = Keyword::where('key',$content)->first()){
            //file_put_contents('avc.php',$keyword);
            //第6步👉：通过关键词模型关联 rule
            $rule = $keyword->rule;
            //第7步👉：不能在浏览器上打印,到public里面生成的文件里面看数据
            file_put_contents('ab.php',$rule['type']);//如果数据是空的可能没关联
            //die;
            //第8步👉：如果能找到对应的关键词
            if($rule['type'] =='text'){
                //文本消息
                //获取所有对应的文本回复
                $responseContent = json_decode($rule->responseText->pluck('content')->toArray()[0],true);
                //从所有回复内容中每次随机一个
                $content = array_random($responseContent)['content'];
                //回复粉丝
                return $instance->text($content);
            }elseif ($rule['type'] =='news'){
                //图文消息
                $news = json_decode($rule->responseNews->toArray()[0]['data'],true);
                return $instance->news([$news]);
            }
        }
        //第13步👉：当匹配不到关键词的时候 执行默认回复
        $content = ResponseBase::find(1);
        return $instance->text($content['data']['default']);
    }
}

<?php

namespace App\Http\Controllers\Home;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //获取指定文章的所有评论数据
    public function index(Request $request,Comment $comment)
    {
        //dd($request->toArray());
        $comments = $comment->with('user')->where('article_id',$request->article_id)->get();
//        dd(11);
//        dd($comments->toArray());
        foreach($comments as $comment){
            $comment->zan_num = $comment->zan->count();
        }
        return ['code'=>1,'message'=>'','comments'=>$comments];
    }

    public function store(Request $request,Comment $comment)
    {
        //执行评论表添加
        $comment->user_id = auth()->id();
        $comment->article_id = $request->article_id;
        $comment->content = $request['content'];
        $comment->save();
        //dd($comment->with('user')->get()->toArray());
        $comment = $comment->with('user')->find($comment->id);
        return ['code'=>1,'message'=>'','comment'=>$comment];
    }


}

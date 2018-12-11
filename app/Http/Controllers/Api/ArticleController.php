<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends CommonController
{
    //获取所有文章数据
    public function articles(){
        //return Article::all();
        //return $this->response->array(Article::find(1));
        //return response()->json(['error' => 'Unauthorized'], 401);
        //return $this->response->error('This is an error.', 404);
        $limit = \request()->query('limit,10');
        $cid = \request()->query('cid');
        if($cid){
            $articles = Article::latest()->where('category_id',$cid)->paginate($limit);
        }else{
            $articles = Article::latest()->paginate($limit);
        }
        //返回所有文章数据,并且每个文章数据中包含一个栏目
        //return $this->response->array(Article::with('category')->get());
        //dingo中的Transformers
        # 返回集合
        //return $this->response->collection(Article::all(),new ArticleTransformer());
        return $this->response->paginator($articles,new ArticleTransformer());
        # 返回单条数据
        //return $this->response->item(Article::find(1),new ArticleTransformer());
    }
    //获取制定一篇文章
    public function show($id){
        return $this->response->item(Article::find($id),new ArticleTransformer());
    }
}

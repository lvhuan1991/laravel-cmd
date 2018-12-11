<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    # 定义可以include可使用的字段
    protected $availableIncludes = ['category','user'];

    public function transform(Article $article)
    {
        return [
            'id' => $article['id'],
            'title' => $article['title'],
            'content' => $article['content'],
            //'created_at' => $article->created_at->toDateTimeString()
            'created_at' => $article->created_at->format('Y-m-d')
        ];
    }
    public function includeCategory(Article $article){
        return $this->item($article->category, new CategoryTransformer());
    }

    public function includeUser(Article $article){
        return $this->item($article->user, new UserTransformer());
    }


}

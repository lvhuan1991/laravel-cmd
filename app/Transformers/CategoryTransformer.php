<?php
/**
 * Created by PhpStorm.
 * User: lvhuan
 * Date: 2018/12/10
 * Time: 19:43
 */

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id'=> $category['id'],
            'title'=> $category['title'],
        ];
    }
}

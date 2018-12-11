<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends CommonController
{
    public function categories(){
        //sleep(2);
        return $this->response->array(Category::all());
    }
}

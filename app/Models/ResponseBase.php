<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseBase extends Model
{
    protected $fillable = ['id'];
    protected $casts = ['data'=>'array'];//内置的方法👉将json数据转为数组格式
}

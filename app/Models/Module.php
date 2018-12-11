<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //protected $fillable = ['name'];//允许填充的字段
    protected $guarded = [];//不允许填充的字段
    protected $casts = [
        'permissions'=>'array'
    ];

}

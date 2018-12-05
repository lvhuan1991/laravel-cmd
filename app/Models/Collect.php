<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    protected $fillable = ['user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    //获取多态关联模型 Article  Comment
    public function manyModel(){
        //因为之前文章和collect多态关联了，评论和collect也多态关联了，所以现在反向关联
        return $this->morphTo('collect');//这个collect代表了数据表里面的collect_id/type
    }
}

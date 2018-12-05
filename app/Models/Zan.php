<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Zan extends Model
{
    protected $fillable = ['user_id'];
    //关联用户
    public function user(){
        return $this->belongsTo(User::class);
    }
    //获取多态关联模型 Article  Comment
    public function belongsModel(){
        //因为之前文章和zan多态关联了，评论和zan也多态关联了，所以现在反向关联
        return $this->morphTo('zan');//这个zan代表了数据表里面的zan_id/type
    }
}

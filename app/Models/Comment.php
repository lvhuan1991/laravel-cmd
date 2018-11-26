<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $casts = ['created_at' => 'datatime:Y-m-d'];
    //关联用户(多对一)
    public function user(){
        return $this->belongsTo(User::class);
    }
}

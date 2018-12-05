<?php

namespace App;

use App\Models\Attachment;
use App\Models\Collect;
use App\Models\Zan;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','email_verified_at','icon'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    //重写 数据库通知中 获取所有通知的 notifications 方法
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')->orderBy('read_at', 'asc')->orderBy('created_at', 'desc');
    }
    //讲登录的时候创建的默认图片；但是没有用到（一直都忘记了）
    public function getIconAttribute( $key )
    {
        //dd($key);
        return $key?:asset('org/images/user.jpg');
    }
    //关联附件（后面2个参数可以省略不写，本来是三个参数的）
    public function attachment(){
        return $this->hasMany(Attachment::class,'user_id','id');
    }
    //获取关注的人(多对多关联;传递四个参数)
    public function following(){
        return $this->belongsToMany(User::class,'followers','following_id','user_id');
    }
    //获取指定用户粉丝(多对多关联;传递四个参数)
    public function fans(){
        return $this->belongsToMany(User::class,'followers','user_id','following_id');
    }
    //用户关联 collect()
    public function collect(){
        return $this->hasMany(Collect::class);
    }
    //用户关联 zan()
    public function zan(){
        return $this->hasMany(Zan::class);
    }

}

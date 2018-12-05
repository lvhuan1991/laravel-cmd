<?php

namespace App\Observers;

use App\Models\Config;

class ConfigObserver
{
    public function created(){
        $this->saveConfigToCache();
    }
    public function updated(){
        $this->saveConfigToCache();
    }
    private function saveConfigToCache(){
        //pluck 手册地址:查询构造器
        //pluck('data','value') 获取两列数据,data 作为键名  ,value 键值
        //手册缓存系统
        \Cache::forever('config_cache',Config::pluck('data','name'));//永久缓存
    }
}

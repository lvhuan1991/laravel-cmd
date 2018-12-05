<?php
//助手函数
if(!function_exists('hd_config')){
    function hd_config($var){
        //dd($var);
        static $cache = [];
        $info = explode('.',$var);
        if(!$cache){
            //清空所有缓存
            //Cache::flush();
            //获取缓存中config_cache数据,如果数据不存在,那么会以第二个参数作为默认值
            $cache = Cache::get('config_cache',function(){
                return\App\Models\Config::pluck('data','name');//获取一列的值
            });
        }
        return $cache[$info[0]][$info[1]]??'';//判断是否存在
        //isset($cache[$info[0]][$info[1]])?$cache[$info[0]][$info[1]]:'';
    }
}
<?php

namespace App\Exceptions;

use Exception;

class UploadException extends Exception
{
    public function render(){
        //方法名字必须是render  产看手册：错误处理 指定了两个方法 report和render
        //return response()->json(['message' =>'上传文件过大', 'code' => 403],200);
        //return response()->json(hdjs要求返回,http状态码200;后盾人里面有实例给的是500);
        return response()->json(['message' =>$this->getMessage(),'code' => 403],200);
    }
}

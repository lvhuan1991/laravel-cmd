<?php

namespace App\Http\Controllers\Util;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        //渲染模板页面
        return view('home.index');
    }
}

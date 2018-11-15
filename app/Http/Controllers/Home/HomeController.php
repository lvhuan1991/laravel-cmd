<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        //得到当前登录用户的信息
        //dd(auth()->user());
        return view('home.index');
    }
}

<?php

namespace App\Http\Controllers\Edu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('edu.home.index');
    }
    public function home(){
        return view('edu.home.home');
    }
    public function store(Request $request){
        dd($request->all());
    }
}

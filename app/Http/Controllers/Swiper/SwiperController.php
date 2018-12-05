<?php

namespace App\Http\Controllers\Swiper;

use App\Models\Swiper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SwiperController extends Controller
{

    public function index()
    {
        //dd(1);
        $swipers = Swiper::latest()->paginate(8);
        //dd($swiper->all());
        return view('swiper.photo.swiper',compact('swipers'));
    }

    public function store(Request $request,Swiper $swiper)
    {
        //dd(1);
        //dd($request->all());
        //dd($swiper);
        $swiper->path = $request->thumb;//赋值
        $swiper->save();//保存到数据库
        //dd($swiper->path);
        return back();

    }

    public function destroy(Swiper $swiper)
    {

        //dd($swiper);
        $swiper->delete();
        return back()->with('success','ok');
    }
}

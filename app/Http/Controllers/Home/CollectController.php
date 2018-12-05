<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectController extends Controller
{
    public function make(Request $request){
        //dd(1);
        $type = $request->query('type');
        $id = $request->query('id');
        $class = 'App\Models\\' . ucfirst($type);
        $model = $class::find($id);
        if($collect = $model->collect->where('user_id',auth()->id())->first()){
            $collect->delete();
        }else{
            $model->collect()->create(['user_id'=>auth()->id()]);
        }
        return back();

    }
}

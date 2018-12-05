<?php

namespace App\Http\Controllers\Wechat;

use App\Models\ResponseBase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResponseBaseController extends Controller
{


    public function create()
    {
        $field = ResponseBase::find(1);//只找第一条，下面只跟新第一条
        //dd($field);
        return view('wechat.response_base.create',compact('field'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $responseBase = ResponseBase::firstOrNew(['id'=>1]);
        //dd($responseBase);
        $responseBase['data'] = $request->all();
        $responseBase->save();
        return back()->with('success','操作成功');
    }

}

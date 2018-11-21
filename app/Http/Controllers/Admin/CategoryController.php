<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequst;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function index()
    {
        //$categories = Category::all();
        $categories = Category::paginate(2);//分页
        //dd($categories);
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequst $request)
    {
        //dd($request->all());打印看看
        Category::create($request->all());
        return redirect()->route('admin.category.index')->with('success','添加成功');
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //dd($category);
        return view('admin.category.edit',compact('category'));
    }


    public function update(CategoryRequst $request, Category $category)
    {
        //dd($category);
        $category->update($request->all());
        return redirect()->route('admin.category.index')->with('success','编辑成功');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('success','删除成功');
    }
}

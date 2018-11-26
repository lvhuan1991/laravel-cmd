<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function __construct(){
        $this->middleware('auth',[
            //'only'=>['create','store','edit','update','destroy'],
            'except'=>['index','show']
        ]);
    }

    public function index(Request $request)
    {
        //测试模型关联
        //$article = Article::find(8);
        //dd($article->toArray());
        //dd($article);
        //dd($article->user);//打印null
        //dd($article->user->name);//打印报错
        //找到跟当前文章分类相同所有文章
        //dd($article->category->article->toArray());该怎么测试?????????
        //测试策略
        //$data = Article::find(10);
        $category = $request->query('category');//接受category参数
        $articles = Article::latest();
        if($category){
            $articles = $articles->where('category_id',$category);
        }
        $articles = $articles->paginate(10);
        //$categories = Category::limit(3)->get();//获取3条栏目
        $categories = Category::all();//获取所有栏目
        //dd($categories);
        return view('home.article.index',compact('articles','categories'));
    }

    //加载创建模板
    public function create()
    {
        //获取所有栏目数据(指的是create模板中的所属栏目下拉列表中的五条数据)但是为什么是用类别category来做参数呢？？？
        $categories = Category::all();
        //dd($categories);//打印的包含所有数据的五条数据对象
        //dd($categories->toArray());//打印的单独的五条属性attributes在一起的二维数组
        return view('home.article.create',compact('categories'));
    }

    //提交、储存
    public function store(ArticleRequest $request,Article $article)
    {
        //获取当前登录用户id
        //dd($request->all());为什么这里获取不到用户id？因为没post提交
        //dd(auth()->id());//打印的就是1
        //dd($article);当前用户肯定是空的
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->content = $request['content'];
        $article->user_id = auth()->id();
        //dd($article);
        $article->save();
        return redirect()->route('home.article.index')->with('success','发布成功');
    }
    //查看详情
    public function show(Article $article)
    {
        
        return view('home.article.show',compact('article'));
    }
    //编辑模板加载
    public function edit(Article $article)
    {
        $this->authorize('update',$article);//相当于@can；弄明白里面每个参数的意思
        //第一个update的意思是指定了策略控制类方法ArticlePolicy中的update方法，第二个参数是指
        //AuthServiceProvider类中的Article::class => ArticlePolicy::class

        $categories = Category::all();//获取所有栏目数据
        //dd($categories->toArray());
        return view('home.article.edit',compact('categories','article'));
    }
    //编辑提交
    public function update(ArticleRequest $request,Article $article)
    {
        $this->authorize('update',$article);//相当于@can
        $article->title = $request->title;
        $article->category_id = $request->category_id;
        $article->content = $request['content'];
        //dd($article);
        $article->save();
        return redirect()->route('home.article.index')->with('success','编辑成功');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete',$article);//相当于@can
        $article->delete();
        return redirect()->route('home.article.index')->with('success','文章删除成功');
    }
}

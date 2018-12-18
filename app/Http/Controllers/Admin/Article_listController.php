<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminModel\Article;

class Article_listController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //资讯列表
        $res = Article::select()->get();
        return view('admin.article.article_list',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加模板
        return view('admin.article.article_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // var_dump($request->all());
        //过滤地段
        $info = $request->except(['_token']);
        
        // 跳转到公告首页
        if (Article::create($info)) {
            return redirect('/adminx/article_list')->with('success','添加成功,待审核');
        }else{
            return back()->withInput()->with('success','添加失败,请重试');            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //显示审核
        // echo $id;
        $info = Article::select()->where('article_id','=',$id)->get();
        // dd($info);
        return view('admin.article.article_review',['info'=>$info]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //修改模板
        // dd($id);
        // echo $id;
        $res = Article::find($id);
        return view('admin.article.article_edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // var_dump($request->all());
        $input = $request->except(['_token','_method']);
        // var_dump($input);
        //执行修改
        if (Article::where('article_id','=',$id)->update($input)) {
            return redirect('/adminx/article_list')->with('success','修改成功');
        }else{
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (Article::where('article_id','=',$id)->delete()) {
            return redirect('/adminx/article_list')->with('success','删除成功');
        }else{
            return redirect('/adminx/article_list')->with('error','删除失败');
        }
    }

    public function review(Request $request)
    {
        //审核
        //审核状态 1位通过 -1为不通过
        $id = $request->input('id');
        $status = $request->except('id');
        //如果提交请求为空 返回
        if ($request->input('article_status') == null) {
            return back()->withInput();
        }else{
            //当修改成功与否
            if (Article::where('article_id','=',$id)->update($status)) {
                return redirect('/adminx/article_list')->with('状态修改成功');
            }else{
                return redirect('/adminx/article_list')->with('状态修改失败');
            }
            
        }
    }

    public function detail(Request $request)
    {
        //显示数据
        // dd($request->all());
        $id = $request->input('id');
        $info = Article::select()->where('article_id','=',$id)->get();
        // dd($info);
        return view('admin.article.article_detail',['info'=>$info]);       
    }
}

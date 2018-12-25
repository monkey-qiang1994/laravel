<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取购物车中的数量
        $cart_num = $this->cart_num();

        $id = $request->input('id');

        if($id){
            //获取新闻数据
            $article = DB::table('article')->paginate(20);
            //获取新闻数据
            $select = DB::table('article')->where('article_id','=',$id)->first();

        }else{
            //获取新闻数据
            $article = DB::table('article')->paginate(20);
            foreach($article as $list){
                $arr[] = $list->article_id;
            }
            $select = DB::table('article')->where('article_id','=',array_rand($arr))->first();
        }
        

        return view('home.notice',['cart_num'=>$cart_num,'article'=>$article,'request'=>$request->all(),'select'=>$select]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

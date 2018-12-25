<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //加载模版
        //判断是否填写了头像
        $data=DB::table('user_details')->where('user_id','=',session('user_id'))->pluck('pic');
        // var_dump($data);
        $info=DB::table('homeuser')->where('user_id','=',session('user_id'))->pluck('username');
        $da=count(DB::table('user_details')->where('user_id','=',session('user_id'))->pluck('pic'));

        //获取购物车中的数量
        $cart_num = $this->cart_num();
        return view('home.user.user_welcome',['data'=>$data,'info'=>$info,'da'=>$da,'cart_num'=>$cart_num]);
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

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
        //获取新品直达
        $news = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where([['products.status','=',2],['products.display','=',0]])
        ->take(5)
        ->get();

        //统计订单
        $order = DB::table('order_list')->where([['order_status','=',0],['user_id','=',session('user_id')]])->get();

        //统计待评价的订单
        $evaluation = DB::table('order_list')
        ->join('order_detail','order_list.order_id','=','order_detail.order_id')
        ->where([['order_list.user_id','=',session('user_id')],['order_detail.evaluation_status','=',0]])
        ->get();

        //收藏数量
        $shoucang = DB::table('shoucang')->where('user_id','=',session('user_id'))->get();

        //优惠卷数量
        $coupon = DB::table('coupon_send')->where('user_id','=',session('user_id'))->get();

        //加载模版
        //判断是否填写了头像
        $data=DB::table('user_details')->where('user_id','=',session('user_id'))->pluck('pic');
        
        $info=DB::table('homeuser')->where('user_id','=',session('user_id'))->pluck('username');
        $da=count(DB::table('user_details')->where('user_id','=',session('user_id'))->pluck('pic'));

        //获取购物车中的数量
        $cart_num = $this->cart_num();
        return view('home.user.user_welcome',['data'=>$data,'info'=>$info,'da'=>$da,'cart_num'=>$cart_num,'news'=>$news,'order'=>$order,'evaluation'=>$evaluation,'shoucang'=>$shoucang,'coupon'=>$coupon]);
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

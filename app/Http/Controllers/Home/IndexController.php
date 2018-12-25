<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取爆款推荐数据
        $recommend = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where([['products.status','=',1],['products.display','=',0]])
        ->take(6)
        ->get();

        //获取新品直达
        $news = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where([['products.status','=',2],['products.display','=',0]])
        ->take(8)
        ->get();

        //获取畅销产品
        $popular = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where([['products.status','=',3],['products.display','=',0]])
        ->take(8)
        ->get();

        //获取打折产品
        $discount = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where([['products.discount_price','!=',''],['products.display','=',0]])
        ->take(8)
        ->get();

        //获取新闻数据
        $article = DB::table('article')->get();

        //获取幻灯片数据
        $slider = DB::table('advertising')->where('ads_position','=',1)->get();

        //获取广告图
        $ads = DB::table('advertising')->where('ads_position','!=',1)->get();

        //获取购物车中的数量
        $cart_num = $this->cart_num();

        //优惠卷开始
        $time = time();
        //优惠券生成模块
        $coupon_list = DB::table('coupon_make')->get();
        //查看数据库中优惠券是否过期
        foreach ($coupon_list as  $v) {
            if ($time > $v->coupon_time) {
                DB::table('coupon_make')->where('coupon_id','=',$v->coupon_id)->update(['coupon_status'=>1]);
                //改变发送的过期的优惠券状态
                DB::table('coupon_send')
                ->join('coupon_make','coupon_make.coupon_id','=','coupon_send.coupon_id')
                ->where('coupon_send.coupon_id','=',$v->coupon_id)
                ->update(['coupon_send.coupon_status'=>1]);
            }
        }
        //优惠卷结束

        //加载首页
        return view("home.index",['recommend'=>$recommend,'news'=>$news,'popular'=>$popular,'discount'=>$discount,'cart_num'=>$cart_num,'slider'=>$slider,'ads'=>$ads,'article'=>$article]);
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

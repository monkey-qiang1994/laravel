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
        ->where('products.status','=',1)
        ->take(6)
        ->get();

        //获取新品直达
        $news = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where('products.status','=',2)
        ->take(8)
        ->get();

        //获取畅销产品
        $popular = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where('products.status','=',3)
        ->take(8)
        ->get();

        //获取打折产品
        $discount = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where('products.discount_price','!=','')
        ->take(8)
        ->get();

        

        //加载首页
        return view("home.index",['recommend'=>$recommend,'news'=>$news,'popular'=>$popular,'discount'=>$discount]);
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

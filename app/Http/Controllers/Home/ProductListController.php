<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProductListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取地址栏的分类id信息
        $cate_id = $request->input('cate_id');
        //获取搜索关键词
        $keyword = $request->input('keyword');

        //如果有从地址栏获取到分类信息的话,去下面匹配该分类下面的所有子类
        if($cate_id){

            $pid = DB::table('category')->where('pid','=',$cate_id)->get();
            
            if(!$pid->isEmpty()){
                //获取到的所属子类后,把子类的id专门遍历到数组中
                foreach($pid as $sub){
                    $arr[] = $sub->cate_id;
                }

                $result = DB::table('products')
                ->join('category','products.cate_id','=','category.cate_id')
                ->join('brand','products.brand_id','=','brand.brand_id')
                ->join('products_images','products.product_id','=','products_images.product_id')
                ->select('products.*','category.cate_name','brand.brand_name','products_images.product_img')
                ->groupBy('products.product_id')
                ->whereIn('products.cate_id',$arr)
                ->paginate(16);

            }else{
                //否则就是该分类没有子类,那么直接显示所有属于这个分类的产品
                $result = DB::table('products')
                ->join('category','products.cate_id','=','category.cate_id')
                ->join('brand','products.brand_id','=','brand.brand_id')
                ->join('products_images','products.product_id','=','products_images.product_id')
                ->select('products.*','category.cate_name','brand.brand_name','products_images.product_img')
                ->groupBy('products.product_id')
                ->where('products.cate_id','=',$cate_id)
                ->paginate(16); 

            }

        }elseif($keyword){

            $result = DB::table('products')
                ->join('category','products.cate_id','=','category.cate_id')
                ->join('brand','products.brand_id','=','brand.brand_id')
                ->join('products_images','products.product_id','=','products_images.product_id')
                ->select('products.*','category.cate_name','brand.brand_name','products_images.product_img')
                ->groupBy('products.product_id')
                ->where('products.product_name','like','%'.$keyword.'%')
                ->paginate(16);
            
        }else{
            $result = DB::table('products')
                ->join('category','products.cate_id','=','category.cate_id')
                ->join('brand','products.brand_id','=','brand.brand_id')
                ->join('products_images','products.product_id','=','products_images.product_id')
                ->select('products.*','category.cate_name','brand.brand_name','products_images.product_img')
                ->groupBy('products.product_id')
                ->paginate(16);
        }
        
        //获取爆款推荐数据
        $recommend = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->select('products.*','products_images.product_img','brand.brand_name')
        ->groupBy('products.product_id')
        ->where([['products.status','=',1],['products.display','=',0]])
        ->take(8)
        ->get();

        //获取商品评价
        $evaluation = DB::table('evaluation_product')->get();

        //获取商品被收藏数,用于显示该商品的人气
        $collection = DB::table('shoucang')->get();

        //获取订单详情中的产品ID,用于显示该商品的销量
        $sales = DB::table('order_detail')->select('product_id')->get();

        //获取购物车中的数量
        $cart_num = $this->cart_num();


        //加载商品列表页面
        return view("home.product_list",['result'=>$result,'request'=>$request->all(),'cart_num'=>$cart_num,'recommend'=>$recommend,'evaluation'=>$evaluation,'collection'=>$collection,'sales'=>$sales]);
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

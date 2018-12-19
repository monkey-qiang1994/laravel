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

        $category = DB::table('category')->get();
        $color = DB::table('attributes')->where('cate_att_id','=',1)->get();
        $size = DB::table('attributes')->where('cate_att_id','=',2)->get();

        $cate_id = $request->input('cate_id');

        $category_pid = DB::table('category')->where('pid','=',$cate_id)->get();

        $result = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('brand','brand.brand_id','=','products.brand_id')
        ->groupBy('products.product_id')
        ->select('products.*','brand.brand_name','products_images.product_img')
        ->paginate(16); 
        

        //获取所有产品数量
        $total = DB::table('products')->get();


        //加载商品列表页面
        return view("home.product_list",['category'=>$category,'color'=>$color,'size'=>$size,'result'=>$result,'request'=>$request->all(),'total'=>$total]);
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

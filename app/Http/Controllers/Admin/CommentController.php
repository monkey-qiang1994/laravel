<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CommentController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        //分页
        //只查询有评价内容的商品
        $data = DB::table('products')
        ->join('category','products.cate_id','=','category.cate_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->join('evaluation_product','evaluation_product.product_id','=','products.product_id')
        ->select('products.*','category.cate_name','brand.brand_name','products_images.product_img')
        ->groupBy('products.product_id')
        ->paginate(10);
        //查询对应商品的评价条数
        foreach ($data as $v) {
            $info = DB::table('evaluation_product')->where('evaluation_product.product_id','=',$v->product_id)->count();
            $arr[$v->product_id] = $info;
        }

        return view('admin.evaluation.comment',['data'=>$data,'arr'=>$arr,'request'=>$request->all()]);

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


    /**
     * 评论用户
     */
    public function user()
    {
        //用户
        return view('admin.order.order_user');
    }

    public function evaluation(Request $request)
    {
        

        if ($request->input('keyword') != null) {
            //查询的关键词
            $keyword = $request->input('keyword');
            $id = $request->input('id');
            $res = DB::table('evaluation_product')
            ->join('order_list','order_list.order_id','=','evaluation_product.order_id')
            ->where([['evaluation_product.product_id','=',$id],['evaluation_product.evaluation_grede','=',$keyword]])
            ->select('evaluation_product.*','order_list.pay_at','order_list.order_num','order_list.user_id')
            ->paginate(2);
        }else{
            $id = $request->input('id');
            $res = DB::table('evaluation_product')
            ->join('order_list','order_list.order_id','=','evaluation_product.order_id')
            ->where('evaluation_product.product_id','=',$id)
            ->select('evaluation_product.*','order_list.pay_at','order_list.order_num','order_list.user_id')
            ->paginate(2);
        }

        
        foreach ($res as $v) {
            $product_id = $v->product_id;
            if ($v->pic_id != null) {
                $pic = DB::table('evaluation_pic')
                ->where('evaluation_pic.evaluation_id','=',$v->evaluation_id)
                ->select('evaluation_pic.pic_path')
                ->get();
                $arr[$v->evaluation_id] =$pic[0]->pic_path;
            }
        }
        if (empty($arr)) {
            $arr = array();
        }
        return view('admin.evaluation.evaluation',['res'=>$res,'arr'=>$arr,'request'=>$request->all(),'product_id'=>$product_id]);
    }
}

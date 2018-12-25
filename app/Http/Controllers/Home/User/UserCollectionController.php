<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询收藏商品的信息
        $data=DB::table('products')
        ->join('shoucang','products.product_id','=','shoucang.product_id')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->where('user_id','=',session('user_id'))
        ->select('products.product_name','products.price','products_images.product_img','shoucang.product_id')
        ->groupBy('products.product_id')
        ->get();
         //获取购物车中的数量
        $cart_num = $this->cart_num();
        // var_dump($data);
        return view('home.user.user_collection',['data'=>$data,'cart_num'=>$cart_num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(request $request)
    {
        // return 1;
        // echo $request->input('product_id');
        // 登录user_id,产品product_id;
        $data['user_id']=session('user_id');
        $data['product_id']=$request->input('product_id');
        // return count(DB::table('shoucang')->where('user_id','=',session('user_id'))->where('product_id','=',$request->input('product_id')));
        // 判断该商品是否被收藏,没有收藏就添加进数据库,收藏就取消收藏删除数据库内容
        if(!DB::table('shoucang')->where('user_id','=',session('user_id'))->where('product_id','=',$request->input('product_id'))->first()){
            if(DB::table('shoucang')->insert($data)){
                echo 1;
            }
        }else{
            if(DB::table('shoucang')->where('user_id','=',session('user_id'))->where('product_id','=',$request->input('product_id'))->delete()){
                echo 0;
            }
            
        }
        
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
        // echo $id;
        //取消收藏
        if(DB::table('shoucang')->where('product_id','=',$id)->delete()){
            return back();
        }else{
            return back();
        }
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

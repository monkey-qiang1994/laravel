<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HomeModel\Order;
use DB;

class Order_payController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //去除token字串
        $input = $request->except('_token','product_id');
        //当未提交为空的时候,阻止表单提交
        if (empty($input)) {
            return back()->with("error",'请选择商品');

        }
        // dd($input);
        $total = 0;
        $num = 0;
        foreach ($input['id'] as $v) {
            // echo $v;
            $info = DB::table('cart')
            ->join('products','products.product_id','=','cart.product_id')
            ->join('products_images','products.product_id','=','products_images.product_id')
            ->where('id','=',$v)
            ->select('cart.*','products.product_name','products.price','products_images.product_img')
            ->get();
            // var_dump($info);
            //要添加进用户详情的数据
            $arr[] = $info[0]->id;
            $res[$v]['product_id'] = $info[0]->product_id;
            $res[$v]['product_num'] =$info[0]->product_num;
            $res[$v]['product_attr'] = $info[0]->product_att;
            $res[$v]['product_price'] = $info[0]->price;
            $res[$v]['product_name'] = $info[0]->product_name;
            $res[$v]['product_img'] = $info[0]->product_img;
            $total += $info[0]->product_num*$info[0]->price;
            $num += $info[0]->product_num;
        }        
        // var_dump($arr);
        //创建订单,默认没地址
        //生成订单号 
        $order['order_num'] = 'U'.mt_rand(100,999).time();
        //生成订单状态,0表示待支付
        $order['order_status']=0;
        //用户id
        $order['user_id']=$info[0]->user_id;
        //当前时间的时间戳
        $order['created_at'] = time();
        //当前订单的总价
        $order['total'] = $total;
        //当前订单内的上行数量
        $order['num'] = $num;
        //当订单生成成功的时候,删除购物车中的id并且生成订单详情
        //获取到插入的id
        $order_id = DB::table('order_list')->insertGetId($order);
        if ($order_id>0) {
            //遍历插入订单生成后的id
            foreach ($input['id'] as $val) {
                //将订单生成后的id插入
                $res[$val]['order_id'] = $order_id;
                
            }
            //插入表
            $arr_length = 0;
            foreach ($res as $value) {
                // var_dump($value);
                //插入订单详情表成功删除购物车内的信息
                DB::table('order_detail')->insert($value);

            }
            //每删除一条数据 arr_length加1 
            foreach ($arr as $row) {
                DB::table('cart')->where('id','=',$row)->delete();
                $arr_length++;
            } 

            //当所有数据全部删除的时候操作完成,跳转
            if (count($arr) == $arr_length) {
                //return redirect('/user/order_cart')->with('order_id',$order_id);
                return redirect('/user/order_cart?order_id='.$order_id);
            }else{
                return back()->withInput();
            }
            
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
        echo "123";
    }

    public function change(Request $request)
    {
        //需要改的数量
        $num = $request->input('num');
        //需要改的购物车id
        $id = $request->input('id');

        if (DB::table('cart')->where('id','=',$id)->update(["product_num"=>$num])) {
            echo 1;
        }else{
            echo 0;
        }
    }

    public function cart_del(Request $request)
    {
        //用户id
        $user_id = 0;
        $product_id = $request->input('product');
        //删除数据库中用户id和商品id什么什么的
        if (DB::table('cart')->where([['product_id','=',$product_id],['user_id','=',$user_id]])->delete()) {
           echo 1;
        }else{
            echo 2;
        }
    }
}






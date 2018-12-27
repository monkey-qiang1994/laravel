<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HomeModel\Order;
use DB;

class Order_cartController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //购物车->支付
        //一次性

        $info = $request->input('order_id');
        //订单详情内的数据
        $detail = DB::table('order_detail')->where('order_id','=',$info)->select()->get();
        //订单表的数据
        $order = DB::table('order_list')->where('order_id','=',$info)->select()->get();
        //当前用户的id
        $user_id  =session('user_id');
        //根据当前登录用户的id查询用户的优惠卷
        $coupon = DB::table('coupon_send')
        ->join('coupon_make','coupon_make.coupon_id','=','coupon_send.coupon_id')
        ->where([['user_id','=',$user_id],['coupon_send.coupon_status','=','0']])
        ->select('coupon_make.*','coupon_send.*')
        ->get();
        //根据当前的用户id 获取所有的地址信息
        $user = DB::table('homeuser')
        ->join('address','address.user_id','=','homeuser.user_id')
        ->where('homeuser.user_id','=',$user_id)
        ->get();

        //获取购物车中的数量
        $cart_num = $this->cart_num();
        return view('home.order.cart_pay',['detail'=>$detail,'order'=>$order,'coupon'=>$coupon,'cart_num'=>$cart_num,'user'=>$user]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
 
        // return view('home.order.cart_pay');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // var_dump($request->all());
        //当前用户
        $user_id = session('user_id');
        //订单id
        $order_id = $request->input('order_id');
        //支付时间
        $time = time();
        //根据优惠券id算出应付金额
        $coupon_id = $request->input('coupon_id');
        //地址id
        $address_id = $request->input('address_id');
        $total = $request->input('total');
        $payable = 0;
        if ($coupon_id != -1) {
            $coupon = DB::table('coupon_make')->where('coupon_id','=',$coupon_id)->get();
            //最低金额
            $coupon_down = $coupon[0]->coupon_down;
            //优惠券金额
            $coupon_price = $coupon[0]->coupon_price;
            //当金额满足优惠券最低条件时
            if ($total>$coupon_down ) {
                //实际付款
                $payable = $total-$coupon_price;
                // echo $payable;
            }else{
                //实际付款
                $payable = $total;
            }

        }else{
            $coupon_id = null;
        }
        // echo $payable;
        $arr['payable'] = $payable;
        $arr['address_id'] = $address_id;
        $arr['coupon_id'] = $coupon_id;
        $arr['pay_at'] = $time;
        // var_dump($arr);
        
        if (DB::table('order_list')->where('order_id','=',$order_id)->update($arr) && DB::table('coupon_send')->where([['coupon_id','=',$coupon_id],['user_id','=',$user_id]])->delete()) {
           return redirect('/user/alipay?order_id='.$order_id );
        }else{
           return redirect('/user/alipay?order_id='.$order_id );

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
    }

    public function order_coupon(Request $request)
    {
        $coupon = $request->input('coupon');
        // echo $coupon;
        if ($coupon != -1 ) {
            $res = DB::table('coupon_make')->where('coupon_id','=',$coupon)->get();
            echo json_encode($res);
        }else{
            echo 0;
        }

    }

    public function alipay(Request $request)
    {
        //传过来的定那个单id
        $id = $request->input('order_id');
        $res = DB::table('order_list')->where('order_id','=',$id)->get();
        //订单号
        $order_num = $res[0]->order_num;
        //将id存储到session中
        session(['id'=>$id]);
        //调用支付宝接口
        pay($order_num);
    }

    public function pay_money()
    {
        $id = session('id');
        if (DB::table('order_list')->where('id','=',$id)->update('order_status','=',1)) {
            return redirect('/user/my_order');
        }else{
            return redirect('/user/my_order');
        }
        
    }
}

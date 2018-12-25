<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class UserCouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //根据当前用户的id 查询所有的优惠券
        $user_id = session('user_id');
        //优惠券信息
        $coupon = DB::table('coupon_send')
        ->join('coupon_make','coupon_make.coupon_id','=','coupon_send.coupon_id')
        ->where('user_id','=',$user_id)
        ->get();

        //获取购物车中的数量
        $cart_num = $this->cart_num();
        return view('home.user.user_coupon',['coupon'=>$coupon,'cart_num'=>$cart_num]);
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

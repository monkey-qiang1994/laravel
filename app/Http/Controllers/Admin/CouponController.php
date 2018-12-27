<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\AdminModel\Coupon_send;
use DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //优惠券管理
        $res = DB::table('coupon_send')
        ->join('coupon_make','coupon_make.coupon_id','=','coupon_send.coupon_id')
        ->select('coupon_make.*','coupon_send.user_id','coupon_send.coupon_status','coupon_send.send_id')
        ->orderby('send_id','ASC')
        ->get();

        return view('admin.coupon.coupon_list',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.coupon.coupon_send');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //将生成的优惠券id 发送给会员
        $id = $request->input('id');
        // echo $id;
        //根据id查询到优惠券详情
        $res = Coupon::where('coupon_id','=',$id)->select()->get();
        // dd($res);
        return view('admin.coupon.coupon_send',['res'=>$res]);
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
        // echo $id;
        if (DB::table('coupon_send')->where('send_id','=',$id)->delete()) {
            return redirect('/adminx/coupon')->with('success','删除成功');
        }else{
            return redirect('/adminx/coupon')->with('error','删除失败');
        }
    }
}

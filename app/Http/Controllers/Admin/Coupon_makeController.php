<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminModel\Coupon;
use App\AdminModel\Coupon_send;
use DB;

class Coupon_makeController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
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
        $res = DB::table('coupon_make')->get();
        return view('admin.coupon.coupon_make',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.coupon.coupon_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //去除_token字符串
        $input = $request->except('_token');
        //转换为unix时间戳
        $input['coupon_time'] = strtotime($input['coupon_time']);
        //优惠券编码
        $input['coupon_num'] = substr(md5(mt_rand('1000','9999')),0,15);
        // dd($input);
        if (Coupon::create($input)) {
            return redirect('/adminx/coupon_make')->with('success','优惠券添加成功');
        }else{
            return redirect('/adminx/coupon_make')->with('error','添加失败');
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
        //删除优惠券
        // echo $id;
        if (Coupon::where('coupon_id','=',$id)->delete()) {
            return redirect('/adminx/coupon_make')->with('success','删除成功');
        }else{
            return redirect('adminx/coupon_make')->with('error','删除失败');
        }
    }

    public function send(Request $request)
    {
        //将生成的优惠券id 发送给会员
        $id = $request->input('id');
        //查看优惠券是否过期
        $info = DB::table('coupon_make')->where('coupon_id','=',$id)->get();
        // dd($info);
        foreach ($info as $v) {
           if ($v->coupon_status == 1) {
              return redirect('/adminx/coupon_make')->with('success','优惠券已过期,发送失败');
           }
        }
        // echo $id;
        //根据id查询到优惠券详情
        $res = Coupon::where('coupon_id','=',$id)->select()->get();
        //查询所有的用户
        $user = DB::table('homeuser')->get();
        // dd($user);
        // dd($res);
        return view('admin.coupon.coupon_send',['res'=>$res,'user'=>$user]);

    }

    public function dosend(Request $request)
    {
        var_dump($request->all());
        //获取优惠券id
        $id = $request->input('id');
        echo "执行发送";
        if ($request->input('coupon_status') == 'all') {
            //所有用户发送,查出数据表中的所有用户的id,执行添加sql语句
            //假装是所有用户
            // $arr = array('1','2','3','4','5');
            $user = DB::table('homeuser')->get();
            //计算所有用户个数
            $count = count($user);
            //初始值
            $num = 0;
            //用户执行添加
            foreach ($user as $key => $value) {
                //模型执行添加
                Coupon_send::create(['user_id'=>$value->user_id,'coupon_id'=>$id]);
                $num++;
            }


            //判断当所有的sql语句执行完毕后
            if ($num == $count) {
                return redirect('/adminx/coupon')->with('success','发送成功');
            }else{
                return redirect('adminx/coupon_send')->with('error','发送失败');
            }

        }else{
            //单个用户发送
            //去除不许要添加进表的字符串
            $input = $request->except(['_token','coupon_status','id']);
            var_dump($input);
            //将筛选后的数组组成一个新数组
            $newarr = array_values($input);
            //统计数组个数
            $count = count($newarr);
            //初始值
            $num = 0;
            // var_dump($newarr);
            foreach ($newarr as $v) {
                //执行添加
               Coupon_send::create(['user_id'=>$v,'coupon_id'=>$id]);
               $num++;
            }

            //判断当所有的sql语句执行完毕
            if ($num == $count) {
                return redirect('/adminx/coupon')->with('success','发送成功');
            }else{
                return redirect('adminx/coupon_send')->with('error','发送失败');
            }
        }
    }
}

<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AdminMOdel\Order;
use DB;
class Order_listController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //订单管理
        // var_dump($request->all()); 
        if ($keyword = $request->input('search') != null) {
            $res = Order::where('order_num','like','%'.$keyword.'%')->orderBy('order_status','ASC')->paginate(5);
        }else{
            $res = Order::orderBy('order_status','ASC')->paginate(5);
        }
        //总数
        $total = Order::count();
        return view('admin.order.order_list',['res'=>$res,'total'=>$total,'request'=>$request->all()]);
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
     * 订单用户
     */
    public function user(Request $request)
    {
        //用户
        $user_id = $request->input('id');
        // var_dump($user_id);
        $user = DB::table('homeuser')
        // ->join('user_details','user_details.user_id','=','homeuser.user_id')
        ->where('homeuser.user_id','=',$user_id)
        ->get();

        foreach ($user as $v) {
            $pic = DB::table('user_details')
            ->join('homeuser','homeuser.user_id','=','user_details.user_id')
            ->where('homeuser.user_id','=',$v->user_id)
            ->get();
        }

        return view('admin.order.order_user',['user'=>$user,'pic'=>$pic]);
    }

    /**
     * 订单详情
     */
    public function detail(Request $request)
    {
        $id = $request->input('id'); 

        $detail = DB::table('order_detail')
        ->where('order_detail.order_id','=',$id)
        ->get();

        //订单详情信息
        $address = DB::table('order_list')
        ->join('order_detail','order_list.order_id','=','order_detail.order_id')
        ->join('address','address.add_id','=','order_list.address_id')
        ->where('order_list.order_id','=',$id)
        ->groupBy('order_list.order_id')
        ->get();
        //订单信息
        $order = DB::table('order_list')
        ->where('order_list.order_id','=',$id)
        ->get();
        // exit;
        //优惠券信息
        foreach ($order as $v) {
            // echo $id;
            if ($v->coupon_id == 0) {
                $coupon = DB::table('order_list')
                ->where('order_list.order_id','=',$v->order_id)
                ->select('order_list.payable','order_list.total')
                ->get();
            }else{
                $coupon = DB::table('coupon_make')
                ->join('order_list','coupon_make.coupon_id','=','order_list.coupon_id')
                ->where([['order_list.order_id','=',$v->order_id]])
                ->select('order_list.total','order_list.payable','coupon_make.*')
                ->get();
            }
            
        }

        return view('admin.order.order_detail',['order'=>$order,'detail'=>$detail,'coupon'=>$coupon,'address'=>$address]);
    }


    public function order_send(Request $request)
    {
        //订单id
        $order_id = $request->input('order_id');

        if (DB::table('order_list')->where('order_id','=',$order_id)->update(['order_status'=>2])) {
            return redirect('/adminx/order_list')->with('success','发货成功');
        }else{
            return redirect('/adminx/order_list')->with('success','发货失败');
        }            
    }

}

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
            $res = Order::where('order_num','like','%'.$keyword.'%')->orderBy('order_status','ASC')->paginate(10);
        }else{
            $res = Order::orderBy('order_status','ASC')->paginate(10);
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
    public function user()
    {
        //用户
        return view('admin.order.order_user');
    }

    /**
     * 订单详情
     */
    public function detail(Request $request)
    {
        $id = $request->input('id'); 

        //订单详情信息
        $detail = DB::table('order_detail')
        ->where('order_detail.order_id','=',$id)
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

        return view('admin.order.order_detail',['order'=>$order,'detail'=>$detail,'coupon'=>$coupon]);
    }

}

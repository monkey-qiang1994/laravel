<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class My_orderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //我的订单
        //根据用户的id 根据状态查询所有的订单数据
        //根据session 获取的id
        $id = session('user_id');
        //所有订单数据
        $all = DB::table('order_list')
        ->where('order_list.user_id','=',$id)
        ->select('order_list.*')
        ->groupBy('order_list.order_id')
        ->orderBy('order_list.order_status')
        ->get();
        
        if (!$all->isEmpty()) {
            //遍历获取所有优惠券信息
            foreach ($all as $v) {
                $arr[] = $v->coupon_id;
                
            }
            //优惠券信息
            $coupon = DB::table('coupon_make')
            ->whereIn('coupon_id',$arr)
            ->get();
        }else{
            $coupon = array();
        }

        //获取购物车中的数量
        $cart_num = $this->cart_num();
        // exit;
        return view('home.order.my_order',['all'=>$all,'coupon'=>$coupon,'cart_num'=>$cart_num]);

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

    public function order_detail(Request $request)
    {
        // var_dump($request->all());
        $id = $request->input('order_id'); 

        //订单详情信息
        $detail = DB::table('order_detail')
        ->where('order_detail.order_id','=',$id)
        ->get();
        //订单信息
        $order = DB::table('order_list')
        ->where('order_list.order_id','=',$id)
        ->get();

        //优惠券信息
        foreach ($order as $v) {
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
        //获取购物车中的数量
        $cart_num = $this->cart_num();
        return view('home.order.order_detail',['order'=>$order,'detail'=>$detail,'coupon'=>$coupon,'cart_num'=>$cart_num]);
    }

    public function order_evaluation(Request $request)
    {
        // echo "订单评价";
        $id = $request->input('id');
        // echo $id;
        $detail = DB::table('order_list')
        ->join('order_detail','order_detail.order_id','=','order_list.order_id')
        ->where('order_list.order_id','=',$id)
        ->get();

        $evaluation = DB::table('order_list')
        ->join('order_detail','order_detail.order_id','=','order_list.order_id')
        ->where('order_list.order_id','=',$id)
        ->groupBy('order_detail.product_id')
        ->get();
        //获取购物车中的数量
        $cart_num = $this->cart_num();
        return view('home.order.order_evaluation',['detail'=>$detail,'evaluation'=>$evaluation,'cart_num'=>$cart_num]);
    }

    public function process_evaluation(Request $request)
    {
        
        //所有信息
        $input = $request->all();
        //评价的商品的id
        $product_id = $request->input('product_id');
        //当前的时间
        $time = time();
        //当前的订单id
        $order_id = $request->input('order_id');
        foreach ($product_id as $v) {
            //判断当前商品是否有文件上传
            if ($request->hasFile('pic'.$v)) {
                //初始化名字
                $pic_name=time()+rand(1,10000);
                //获取上传文件的后缀
                $ext=$request->file("pic".$v)->getClientOriginalExtension();
                //将文件移动到指定目录下
                $request->file("pic".$v)->move("./uploads/evaluation",$pic_name.".".$ext);
                //手动拼接路径
                $path['pic_path'] = "/uploads/evaluation/".$pic_name.".".$ext;
                //插入数据表,返回插入的id
                $pic_id = DB::table('evaluation_pic')->insertGetId($path);
                $arr[$v]['pic_id'] = $pic_id;
                echo $pic_id;
            }

            //评价星级
            if (in_array($request->input('grade'.$v),$input)) {
                $arr[$v]['evaluation_grede'] = $request->input('grade'.$v);
            }
            //评价内容
            if (in_array($request->input('content'.$v),$input)) {
                if ($request->input('content'.$v) == null) {
                   $arr[$v]['evaluation_connect'] = "用户未作出评价,系统默认好评";
                }else{
                    $arr[$v]['evaluation_connect'] = $request->input('content'.$v);
                }
            }
            //其他字段
            $arr[$v]['order_id'] = $order_id;
            $arr[$v]['product_id']=$v;
            $arr[$v]['evaluation_time'] = $time;

        }

        foreach ($arr as $value) {
            //当存在有图片id时,获取插入后的id插入到关联的图片表中
            if (array_key_exists('pic_id',$value)) {
                //图片的id
                $pic_id = $value['pic_id'];
                //插入成功后返回的评价表的id
                $evaluation_id = DB::table('evaluation_product')->insertGetId($value);
                if (DB::table('evaluation_pic')->where('pic_id','=',$pic_id)->update(['evaluation_id'=>$evaluation_id])) {
                    //当信息插入成功后,将订单的状态改为4
                    DB::table('order_list')->where('order_id','=',$order_id)->update(['order_status'=>4]);

                    return redirect('/user/my_order')->with('success','评价成功感谢您的支持');
                }else{
                    return redirect('/user/my_order')->with('error','评价失败-请刷新后重试');
                }                
            }else{
                if (DB::table('evaluation_product')->insert($value)) {
                    //当信息插入成功后,将订单的状态改为4
                    DB::table('order_list')->where('order_id','=',$order_id)->update(['order_status'=>4]);
                    return redirect('/user/my_order')->with('success','评价成功感谢您的支持');
                }else{
                    return redirect('/user/my_order')->with('error','评价失败-请刷新后重试');
                }
                
            }
           
        }

    }


}

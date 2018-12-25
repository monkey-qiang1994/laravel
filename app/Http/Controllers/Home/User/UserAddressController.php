<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(session('user_id'));
        //根据登录时session('user_id')获取用户的所有地址,遍历
        $info=DB::table('address')->where('user_id','=',session('user_id'))->get();
        // var_dump($info);
        //获取购物车中的数量
        $cart_num = $this->cart_num();

        return view('home.user.user_address',['info'=>$info,'cart_num'=>$cart_num]);
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
        // dd($request->all());
        // dd(session('user_id'));
        // dd($request->input('checkbox'));
        // 判断在添加新地址时是否点击设置该地址为默认地址 1为默认地址
        if($request->input('checkbox')=='on'){
            //将其他地址status改为0
            DB::table('address')->where('user_id','=',session('user_id'))->update(['status'=>0]);
            //获取添加的信息
            $data=$request->except(['_token','checkbox']);
            $data['status']=1;
            $data['user_id']=session('user_id');
            // dd($data);
            // 将新地址添加到数据库
            DB::table('address')->where('user_id','=',session('user_id'))->insertGetId($data);
            return back()->with('success','成功添加新的默认地址');
        }else{
            //添加地址时没设置默认 status 为0
            $data=$request->except(['_token']);
            $data['status']=0;
            $data['user_id']=session('user_id');
            //将数据库添加进数据库
            DB::table('address')->where('user_id','=',session('user_id'))->insertGetId($data);
            return back()->with('success','添加新地址成功');
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
        //获取购物车中的数量
        $cart_num = $this->cart_num();
        //加载修改页面
        return view('home.user.user_address_edit',['cart_num'=>$cart_num]);
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
        // dd($id);
        $del=DB::table('address')->where('add_id','=',$id)->delete();
        if($del){
            return redirect('/user/address')->with('success','删除成功');
        }else{
            return redirect('/user/address')->with('error','删除失败');
        }
    }

    public function moren($id)
    {
        // dd($id);
        //设置默认地址,将所有地址status变为0 ,对应的add_id status改为1
        DB::table('address')->where('user_id','=',session('user_id'))->update(['status'=>0]);
        if( DB::table('address')->where('add_id','=',$id)->update(['status'=>1])){
            return redirect('/user/address')->with('success','设置成功');
        }else{
            return redirect('/user/address')->with('error','设置失败');
        }
       
    }
}

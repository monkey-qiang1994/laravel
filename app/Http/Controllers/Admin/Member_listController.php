<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Member_listController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        //获取搜索关键词
        $k=$request->input('keywords');
        //会员列表
        $user=DB::table('homeuser')->where('username','like','%'.$k.'%')->paginate(5);
        return view('admin.member_list',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        //查看状态
        $data=DB::table('homeuser')->where('user_id','=',$id)->first();

        if($data->status==0){
            DB::table('homeuser')->where('user_id','=',$id)->update(['status'=>1]);
        }else{
            DB::table('homeuser')->where('user_id','=',$id)->update(['status'=>0]);
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
        // echo $id;
        if(DB::table('homeuser')->where('user_id','=',$id)->delete()){
            return redirect('adminx/member_list')->with('success','数据删除成功');
        }else{
            return redirect('adminx/member_list')->with('error','数据删除失败');
        }
    }
}

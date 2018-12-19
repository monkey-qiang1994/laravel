<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class Admin_roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //管理员列表
        //获取数据
        $admin=DB::table('admin_user')->paginate(5);
        //加载模板
        return view('admin.admin_role',['admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd ($_POST);
        // 判断两次密码是否一致
        if($_POST['password']==$_POST['repassword']){
            $request->flashOnly('username');
            $data=$request->only(['username','password']);
            // dd($data);
            //密码加密
            $data['password']=Hash::make($data['password']);
            //判断是否添加成功
            if(DB::table('admin_user')->insert($data)){
                return redirect("/adminx/admin_role")->with('success','添加成功');
            }else{
                return redirect("/adminx/admin_role")->with('error','添加失败');
            }
        }else{
            return redirect("/adminx/admin_role")->with('error','添加失败');
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
        // dd($request->all());
        //获取数据
        $data=$request->except('repassword','_token','_method');
        // dd($data);
        //密码加密
        $data['password']=Hash::make($data['password']);
        //判断是否添加成功
        if(DB::table("admin_user")->where("admin_id","=",$data['admin_id'])->update($data)){
            return redirect("/adminx/admin_role")->with('success',"数据修改成功");
        }else{
            return redirect("/adminx/admin_role")->with('error','数据修改失败');
        }

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
        if(DB::table('admin_user')->where('admin_id',"=",$id)->delete()){
            return redirect("/adminx/admin_role")->with('success','数据删除成功');
        }else{
            return redirect("/adminx/admin_role")->with('error','数据删除失败');
        }
    }
}

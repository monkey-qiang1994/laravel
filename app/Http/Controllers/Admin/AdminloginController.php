<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class AdminloginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //退出
        //销毁session
        $request->session()->pull('username');
        //跳转
        return redirect('/adminlogin/create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载后台登录模板
        return view('admin.adminlogin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //根据输入的用户名获取用户信息
         
         $user=DB::table('admin_user')->where("username",'=',$request->input('username'))->first();
        // 检测用户
        if($user){
            // echo 'ok';
            //检测密码
            if(Hash::check($request->input('password'),$user->password)){
                // echo "登录成功";
                // 把登录信息写入到session
                session(['username'=>$user->username]);
                // 1.获取用户的所有权限列表
                $list=DB::select("select n.name,n.mname,n.aname from user_role as
                ur,role_node as rn,node as n where ur.rid=rn.rid and rn.nid=n.id and uid={$user->admin_id}");
                // var_dump($list);exit;
                // dd($list);  
                //2.初始化权限信息
                //把后台首页权限写入到权限信息列表里
                $nodelist['WelcomeController'][]='index';
                //遍历
                foreach($list as $v){
                    $nodelist[$v->mname][]=$v->aname;
                    //如果有create 添加store方法
                    if($v->aname=="create"){
                        $nodelist[$v->mname][]="store";
                    }
                    //如果有edit 方法 添加update方法
                    if($v->aname=="edit"){
                        $nodelist[$v->mname][]="update";
                    }
                }
                // var_dump($nodelist);exit;
                //3.登录用户所有权限列表信息存储在session里view
                session(['nodelist'=>$nodelist]);

                return redirect('/adminx')->with('success','登录成功');
            }else{
                return back()->with('error',"密码错误");
            }
        }else{
            return back()->with('error',"用户名错误");
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
}

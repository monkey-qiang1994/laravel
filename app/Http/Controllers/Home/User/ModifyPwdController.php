<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;

class ModifyPwdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //根据登入时存在session的用户user_id,查看用户信息
        $data=DB::table('homeuser')->join('user_details','homeuser.user_id','=','user_details.user_id')->first();
        // dd($data);
        //获取购物车中的数量
        $cart_num = $this->cart_num();

        return view('home.user.user_modifypwd',['data'=>$data,'cart_num'=>$cart_num]);
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
        // dd($id);
        // dd($request->all());
        // 获取修改后的数据homeuser表($data),user_details表($info);
        $data=$request->only(['username','password','email','phone']);
        $info=$request->only(['age','address','sex']);
        // dd($data);
        // 密码加密
        if(!$data['password']==null){
             $data['password']=Hash::make($data['password']);
            //判断是否修改成功
            if(DB::table('homeuser')->where('user_id','=',$id)->update($data)){
                if(DB::table('user_details')->where('user_id','=',$id)->update($info)){
                    return redirect('/user/modifypwd')->with('success','修改成功');
                }else{
                      return redirect('/user/modifypwd')->with('error','修改失败,请重新修改');
                }
            }else{
                return redirect('/user/modifypwd')->with('error','修改失败,请您重新修改');
            }
        }else{
            return redirect('user/modifypwd')->with('error','密码不能为空,请填写密码');
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
        //
    }
}

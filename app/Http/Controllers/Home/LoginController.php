<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use Mail;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session('username')->pull('username');
        $request->session('user_id')->pull('user_id');
        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取购物车中的数量
        $cart_num = $this->cart_num();

        //加载注册/登陆页面
        return view('home.login',['cart_num'=>$cart_num]);
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
        //获取用户信息
        
        $user=DB::table('homeuser')->where('phone','=',$request->input('phone'))->first();
        // dd($user);
        // dd($user->password);
        // dd($request->password);
        //检测用户
        if($user){
            //检测密码
            if(Hash::check($request->input('password'),$user->password)){
                if($user->status==1){
                     // 将用户user_id,username存入session
                    session(['user_id'=>$user->user_id]);
                    session(['username'=>$user->username]);
                    // var_dump(session('username'));
                    return redirect('/')->with('success','登录成功');
                }else{
                    return back()->with('error','请进入邮箱激活用户');
                }
               
            }else{
                return back()->with('error','密码错误,请重新输入密码');
            }
        }else{
            return back()->with('error','手机号错误,请重新输入手机号');
        }
    }

    public function sendMails($email,$id,$token){
        //在闭包函数内部使用闭包函数外部的变量 必须use 导入 a 是模板
        Mail::send('Home.Register.reset',['id'=>$id,'token'=>$token],function($message)use($email){
            //发送主题
            $message->subject('菲诺商城-激活账户');
            //接收方
            $message->to($email);
        });
        return true;
    }

    public function forget(Request $request){
        // dd($request->email);
        $email=$request->input('email');
        $info=DB::table('homeuser')->where('email','=',$email)->first();
        //发送邮件
        $res=$this->sendMails($email,$info->user_id,$info->token);
        if($res){
            echo "重置密码邮件已经发送,请注意查收邮件";
        }
    }

    public function reset(Request $request){
        // echo 111;
        $id=$request->input('user_id');
        $info=DB::table('homeuser')->where('user_id','=',$id)->first();
        $token=$request->input('token');
        //对比邮件的token和数据表的token
        if($token==$info->token){
            return view("Home.Register.doreset",['user_id'=>$id]);
        }
    }

    //执行密码重置
    public function doreset(Request $request){
        $password=$request->input('password');
        $user_id=$request->input('user_id');
        // echo $password.':'.$user_id;
        //执行修改
        $data['password']=Hash::make($password);
        $data['token']=rand(1,10000);
        if(DB::table('homeuser')->where('user_id','=',$user_id)->update($data)){
            return redirect('/login/create');
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

<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Hash;
use Mail;
 //引入第三方验证码类库
use Gregwar\Captcha\CaptchaBuilder;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function send()
    {
        //Mail laravel框架邮件封装类
        //邮件消息生成器 $message
        Mail::raw('this is xiangmu', function ($message) {
        //发送主题
        $message->subject('xiangmu');
        //接收方
        $message->to("992168086@qq.com");
        });
    }

    //发送纯文本 视图和数据 $email 接收方 $id注册用户id $token 校验参数
    public function sendMail(){
        //在闭包函数内部使用闭包函数外部的变量 必须use 导入 a 是模板
        Mail::send('Home.Register.a',['id'=>10],function($message){
            //发送主题
            $message->subject('激活');
            //接收方
            $message->to('992168086@qq.com');
        });
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

    public function sendMails($email,$id,$token){
        //在闭包函数内部使用闭包函数外部的变量 必须use 导入 a 是模板
        Mail::send('Home.Register.jihuo',['id'=>$id,'token'=>$token],function($message)use($email){
            //发送主题
            $message->subject('激活');
            //接收方
            $message->to($email);
        });
        return true;
    }

    public function jihuo(Request $request){
        // dd($request->all());
        //获取id和token
        $id=$request->input('user_id');
        $token=$request->input('token');
        // dd($token);
        // 对比 邮件里token和数据表里的token是否一致
        $info=DB::table('homeuser')->where('user_id','=',$id)->first();
        // dd($info);
        if($token==$info->token){
            //把status的值有0变为1
            $data['status']=1;
            $data['token']=rand(1,10000);
            $da=DB::table('homeuser')->where('user_id','=',$id)->update($data);
            echo '<script>alert("激活成功,您现在可以登录了");location="/"</script>';
        }
        
    }

    //引入验证码
    public function code(){
        // 生成校验码代码
        ob_clean();//清除操作
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 34, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        session(['vcode'=>$phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
        // die;
    }

    public function checkphone(Request $request){
        $p=$request->input('p');
        // echo $p;
        // 获取homeuser 数据表 phone 一列数据
        $phone=DB::table("homeuser")->pluck('phone');
        $arr=array();
        //获取的对象集合转换为数组
        foreach($phone as $key=>$v){
            $arr[$key]=$v;
        }
        //对比
        if(in_array($p,$arr)){
            echo 1;//手机号已注册
        }else{
            echo 0;//手机号可注册
        }
    }

    public function register(Request $request){
        // dd($request->all());
        //获取输入的验证码
        $code=$request->input('code');
        //获取系统的校验码
        $vcode=session('vcode');
        // echo $code.":".$vcode;
        // 判断验证码
        if($code==$vcode){
            // echo 'ok';
            // 判断输入密码
            if($request->input('password')==$request->input('repassword')){
                $data=$request->except(['_token','repassword','code']);
                //密码加密
                $data['password']=Hash::make($data['password']);
                $data['status']=0;//代表没有激活;
                $data['token']=rand(1,10000);
                $data['created_at']=time();
                //入库
                $id=DB::table("homeuser")->insertGetId($data);
                if($id){
                    // echo 1;
                    // 邮件激活用户,把状态值0改为1
                    $res=$this->sendMails($data['email'],$id,$data['token']);//$email 接收方 $id注册用户的id $token检测参数
                    if($res){
                        // echo '激活邮件已发送,请登录邮箱激活';
                        echo '<script>alert("注册成功,请登录邮箱激活");location="/"</script>';
                    }
                }
            }else{
                return back()->with('error','两次密码不一致,请重新填写密码');
            }
        }else{
            return back()->with('error','校验码有误,请重新输入');
        }
        
    }
}

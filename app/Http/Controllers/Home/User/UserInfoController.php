<?php

namespace App\Http\Controllers\home\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //获取购物车中的数量
        $cart_num = $this->cart_num();

        return view('home.user.user_info',['cart_num'=>$cart_num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(session('user_id'));
        // dd($request->all());
        //判断是否有个人详细信息
        $id=DB::table("user_details")->where('user_id','=',session('user_id'))->first();
        if(!$id){
            $data['address']=$request->input('address');
            $data['sex']=$request->input('sex');
            $data['age']=$request->input('age');
            $data['user_id']=session('user_id');
            //判断是否具有文件上传
            if($request->hasFile('pic')){
                //初始化名字
                $name=time()+rand(1,10000);
                //获取上传文件后缀
                // $ext=$request->file('pic')->extension();
                $ext=$request->file("pic")->getClientOriginalExtension();
                // dd($ext);
                //移动到指定的目录下（提前在public下新建uploads目录）
                $request->file("pic")->move(".\uploads\user",$name.".".$ext);
                $data['pic']="/uploads/user/".$name.".".$ext;
            }
            $info=DB::table('user_details')->insert($data);
            if($info){
                return redirect('/user/info')->with('success','添加信息成功');
            }else{
                return redirect('/user/info')->with('error','添加失败,请您重新添加');
            }
        }else{
            return redirect('/user/info')->with('error','添加失败,您已添加过信息了,如要修改信息,请点击下方个人信息栏进行修改');
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
        // echo $id;
        $data=DB::table('user_details')->where('user_id','=',$id)->first();
        //判断是否有个人信息有就是1
        $info=count(DB::table('user_details')->where('user_id','=',$id)->first());
        //获取购物车中的数量
        $cart_num = $this->cart_num();
        //加载模板
        if($info==1){

            return view('home.user.user_edit',['data'=>$data,'info'=>$info,'cart_num'=>$cart_num]);
        }else{
            return back()->with('error','请先添加信息后在修改');
        }
        
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
        // var_dump($request->all());
            $data['address']=$request->input('address');
            $data['sex']=$request->input('sex');
            $data['age']=$request->input('age');
            $data['user_id']=session('user_id');
            //判断是否具有文件上传
            if($request->hasFile('pic')){
                //初始化名字
                $name=time()+rand(1,10000);
                //获取上传文件后缀
                // $ext=$request->file('pic')->extension();
                $ext=$request->file("pic")->getClientOriginalExtension();
                // dd($ext);
                //移动到指定的目录下（提前在public下新建uploads目录）
                $request->file("pic")->move(".\uploads\user",$name.".".$ext);
                $data['pic']="/uploads/user/".$name.".".$ext;
            }
            $info=DB::table('user_details')->update($data);
            if($info){
                return back()->with('success','修改信息成功');
            }else{
                return back()->with('error','修改失败,请您重新修改');
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

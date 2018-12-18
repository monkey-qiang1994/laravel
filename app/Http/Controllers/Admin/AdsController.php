<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminUserInsert;
use DB;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //广告模块
        //查询所有数据
        $info = DB::table('advertising')->get();
        return view('admin.ads.ads',['info'=>$info]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加广告
        return view('admin.ads.ads_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserInsert $request)
    {
        //
        if($request->hasFile('pic')){
            //判断上传文件的格式,我就不判断了
            //初始化名字
            $name='COMMODITY'.time().mt_rand(100,999);
            //获取上传文件后缀
            $ext=$request->file("pic")->getClientOriginalExtension();
            //移动到指定的目录下（public下uploads目录）
            $request->file("pic")->move("./uploads/slider",$name.".".$ext);
            //获取除 _token,pic以外的参数
            $input = $request->except(['_token','pic']);
            //文件名
            $input['ads_path'] = $name.".".$ext ;
            if (DB::table('advertising')->insert($input)) {
                return redirect('/adminx/ads')->with('success','添加成功');
            }else{
                return redirect('/adminx/ads')->with('error','添加失败');               
            }
            
        }else{
           return redirect('/adminx/ads/create')->with('error','文件上传失败');
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
        //加载修改模板
        //根据id查询单条数据
        $res = DB::table('advertising')->where("ads_id",'=',$id)->first();
        // dd($res);
        return view('admin.ads.ads_edit',['res'=>$res]);
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
        if ($request->hasFile('pic')) {
            //初始化名字
            $name='COMMODITY'.time().mt_rand(100,999);
            //获取上传文件后缀
            $ext=$request->file("pic")->getClientOriginalExtension();
            //移动到指定的目录下（public下uploads目录）
            $request->file("pic")->move("./uploads/slider",$name.".".$ext);     
            //不需要写入表单的字段
            $input = $request->except(['_token','_method','pic']);
            //添加合成的图片地址
            $input['ads_path'] = $name.".".$ext ;
            //过滤数组中的空值
            $info = array_filter($input);
            // dd($info);
            if (DB::table('advertising')->where('ads_id','=',$id)->update($info)) {
                return redirect('/adminx/ads')->with('success','修改成功');
            }else{
                return back()->withInput()->with('error','修改失败');
            }
        }else{
            //如果没有文件上传
            // var_dump($request->all());
            $info = $request->except(['_token','_method']);
            // dd($info);
            //写入数据库
            if (DB::table('advertising')->where('ads_id','=',$id)->update($info)) {
                return redirect('/adminx/ads')->with('success','修改成功');
            }else{
                return back()->withInput()->with('error','修改失败');
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //当数据Uploads下的文件已经删除的情况下会报错
        //获取传过来的图片
        $pic = $request->input('pic');
        // dd($request->all());
        if (DB::table('advertising')->where('ads_id','=',$id)->delete()) {
            //删除文件中的图片
            unlink('./uploads/slider'.$pic);
            return redirect('adminx/ads')->with('success','删除成功');
        }else{
            return redirect('amdinx/ads')->with('error','删除失败');
        }
    }

    
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Product_attributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //判断访问的是属性分类还是属性分类下的属性值
        if($request->input('cate_att_id')){

            //获取对应分类的属性值的数据
            $att_value = DB::table('attributes')->where('cate_att_id','=',$request->input('cate_att_id'))->get();
            //获取属性分类的所有数据
            $att_list = DB::table('cate_attributes')->get();

            return view('admin.product_attribute_value',['att_value'=>$att_value,'att_list'=>$att_list]);

        }else{

            //获取属性分类的数据
            $att_list = DB::table('cate_attributes')->get();
            //获取属性值的数据
            $att_value = DB::table('attributes')->get();
            //加载模版
            return view('admin.product_cate_attribute',['att_list'=>$att_list,'att_value'=>$att_value]);
        }
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
        //判断添加的是属性还是属性分类
        if($request->input('att_value')){
            $value = $request->except('_token','att_value');

            //验证属性名不能为空
            $this->validate($request, [
                'att_name' => 'required',
            ]);

            if(DB::table('attributes')->insert($value)){
                return back()->with('success',"属性添加成功");
            }else{
                return back()->with('error',"属性添加成功");
            }

        }else{

            //验证分类名不能为空
            $this->validate($request, [
                'cate_att_name' => 'required',
            ]);

            $cate_att_name['cate_att_name'] = $request->input('cate_att_name');

            if(DB::table('cate_attributes')->insert($cate_att_name)){
                return back()->with('success',"分类添加成功");
            }else{
                return back()->with('error',"分类添加失败");
            }

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
    public function update(Request $request)
    {
        if($request->input('att_value')){

            $data = $request->except('_token','_method','att_value');
            $id = $data['att_id'];
            if(DB::table('attributes')->where('att_id','=',$id)->update($data)){
                return back()->with('success',"分类修改成功");
            }else{
                return back()->with('error',"分类修改失败");
            }

        }else{

            $data = $request->except('_token','_method');
            $id = $data['cate_att_id'];
            if(DB::table('cate_attributes')->where('cate_att_id','=',$id)->update($data)){
                return back()->with('success',"分类修改成功");
            }else{
                return back()->with('error',"分类修改失败");
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
        if($request->att_value){

            if(DB::table('attributes')->where('att_id','=',$id)->delete()){
                return back()->with('success',"属性删除成功");
            }else{
                return back()->with('error',"属性删除失败");
            }

        }else{
            
            //查询删除的分类是否有子分类
            $del = DB::select("SELECT cate_att_id FROM attributes WHERE cate_att_id IN ('".$id."')");
            if($del){
                return back()->with('error',"该分类有属性,请先删除属性");
            }else{
                DB::table('cate_attributes')->where('cate_att_id','=',$id)->delete();
                return back()->with('success',"分类删除成功");
            }
        }
    }
}

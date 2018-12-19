<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入表单请求效验类
use App\Http\Requests\ProductInsert;
use DB;
class Product_listController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取所有产品数量,专门用于统计数量
        $total = DB::table('products')->get();
        //分页
        $data = DB::table('products')
        ->join('category','products.cate_id','=','category.cate_id')
        ->join('brand','products.brand_id','=','brand.brand_id')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->select('products.*','category.cate_name','brand.brand_name','products_images.product_img')
        ->groupBy('products.product_id')
        ->paginate(5);
    
        $status = array('无状态','爆款推荐','新品直达','畅销产品');
        //产品管理
        return view('admin.product_list',['data'=>$data,'status'=>$status,'request'=>$request->all(),'total'=>$total]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取全部(给产品选择分类)
        $cate_list = DB::table('category')->select(DB::raw('*,concat(path,",",cate_id) as paths'))->orderBy('paths')->get();
        //分割符
        foreach($cate_list as $key=>$value){
            //转换为数组
            $arr=explode(",",$value->path);
            //获取逗号的个数
            $len=count($arr)-1;
            //给当前的分类添加分隔符
            $cate_list[$key]->cate_name = str_repeat('--|',$len).$value->cate_name;
        }

        //获取所有品牌信息
        $brand_list = DB::table('brand')->get();

        //获取产品属性分类信息
        $cate_att = DB::table('cate_attributes')->get();

        //获取产品属性信息
        $attributes = DB::table('attributes')->get();

        return view('admin.product_add',['cate_list'=>$cate_list,'brand_list'=>$brand_list,'cate_att'=>$cate_att,'attributes'=>$attributes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductInsert $request)
    {

        $data = $request->except('_token','pics');
        //把选中的产品属性变成字符串,以便于存入数据库
        $data['att_id'] = implode(',',$data['att_id']);
        //获取插入的商品ID,用于插入图片
        $id = DB::table('products')->insertGetId($data);

        //多图片存入到文件中
        foreach($request->file('pics') as $file) {
            //初始化名字
            $name=time()+rand(1,10000);
            //获取上传文件后缀
            $ext = $file->getClientOriginalExtension();
            //移动图片
            $file->move(base_path().'/public/uploads/products', $name.'.'.$ext);
            //将图片路径存入到数组中
            $imgs[] = '/uploads/products/'.$name.'.'.$ext;
        }

        //循环把图片数据插入到数据库中
        foreach($imgs as $v){
            DB::table('products_images')->insert(['product_id'=>$id,'product_img'=>$v]);
        }

        if($id){
            return redirect('/adminx/product_list')->with("success",'产品添加成功');
        }else{
            return back()->with("error",'产品添加失败');
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
        //遍历默认信息
        //获取全部(给产品选择分类)
        $cate_list = DB::table('category')->select(DB::raw('*,concat(path,",",cate_id) as paths'))->orderBy('paths')->get();
        //分割符
        foreach($cate_list as $key=>$value){
            //转换为数组
            $arr=explode(",",$value->path);
            //获取逗号的个数
            $len=count($arr)-1;
            //给当前的分类添加分隔符
            $cate_list[$key]->cate_name = str_repeat('--|',$len).$value->cate_name;
        }

        //获取所有品牌信息
        $brand_list = DB::table('brand')->get();

        //获取产品属性分类信息
        $cate_att = DB::table('cate_attributes')->get();

        //获取产品属性信息
        $attributes = DB::table('attributes')->get();


        //获取商品信息
        $edit = DB::table('products')->where('products.product_id','=',$id)->first();
        //获取商品图片信息
        $edit_img = DB::table('products_images')->where('product_id','=',$id)->get();
        //把属性值变为数组格式
        $edit->att_id = explode(',',$edit->att_id);


        return view('admin.product_edit',['edit'=>$edit,'edit_img'=>$edit_img,'cate_list'=>$cate_list,'brand_list'=>$brand_list,'cate_att'=>$cate_att,'attributes'=>$attributes]);
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
        //过滤信息
        $data = $request->except('_token','_method','pics');
        //把商品属性再转换为字符串
        $data['att_id'] = implode(',',$data['att_id']);

        //如果有传新图片的话,循环插入新图片
        if($request->hasFile('pics')){
            foreach($request->file('pics') as $file) {
                //初始化名字
                $name=time()+rand(1,10000);
                //获取上传文件后缀
                $ext = $file->getClientOriginalExtension();
                //移动图片
                $file->move(base_path().'/public/uploads/products', $name.'.'.$ext);
                //将图片路径存入到数组中
                $imgs[] = '/uploads/products/'.$name.'.'.$ext;
            }

            //循环把图片数据插入到数据库中
            foreach($imgs as $v){
                DB::table('products_images')->update(['product_id'=>$id,'product_img'=>$v]);
            }
        }

        //插入数据库
        if(DB::table('products')->where('product_id','=',$id)->update($data)){
            return redirect('/adminx/product_list')->with("success",'产品修改成功');
        }else{
            return redirect('/adminx/product_list')->with("error",'产品修改失败');
        }

    }

    //ajax删除图片
    public function delete(Request $request){
        $id = $request->input('id');
        //获取要删除的图片信息
        $img = DB::table('products_images')->where('img_id','=',$id)->first();

        unlink('.'.$img->product_img);

        if(DB::table('products_images')->where('img_id','=',$id)->delete()){
            echo 1;
        }else{
            echo 2;
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
        
        $imgs = DB::table('products_images')->where('product_id','=',$id)->get();
        foreach($imgs as $img){
            unlink('.'.$img->product_img);
        }

        //删除所有产品资料
        if(DB::table('products')->where('product_id','=',$id)->delete()){
            return redirect('/adminx/product_list')->with("success",'产品删除成功');
        }else{
            return redirect('/adminx/product_list')->with("error",'产品删除失败');
        }
    }

    //更新产品的状态
    public function display(Request $request){
        $data = $request->except('_token');

        if(DB::table('products')->where('product_id','=',$data['id'])->update(['display'=>$data['display']])){
            return redirect('/adminx/product_list')->with("success",'产品上下架更新成功!');
        }else{
            return redirect('/adminx/product_list')->with("error",'产品上下架更新失败!');
        }
    }

    //ajax批量删除
    public function delall(Request $request){
        $id = $request->input('a');
        foreach($id as $key=>$v){
            DB::table('products')->where('product_id','=',$v)->delete();
        }

        echo 1;
    }

}

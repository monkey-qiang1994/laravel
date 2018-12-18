<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Product_categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //获取全部(给添加分类用)
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

        //1.判断是否有子类 默认获取的是对象
        $pid = DB::select("SELECT pid FROM category");
        //2.将对象转为数组 默认是二维数组
        $array = array_map('get_object_vars', $pid);
        //3.通过两次循环 把二维数组变成一维
        foreach($array as $key=>$value){
            foreach($value as $v){
                $pids[$key]=$v;
            }
        }
        
        //获取地址栏的pid 如果没有默认给0顶级分类
        $get = $request->input('pid',0);

        if($get){
            $result = DB::table('category')->where('pid','=',$get)->paginate(5);
        }else{
            $result = DB::table('category')->where('pid','=',0)->paginate(5);
        }


        //分类页面加载
        return view('admin.product_category',['result'=>$result,'cate_list'=>$cate_list,'pids'=>$pids,'request'=>$request->all()]);

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
        //验证分类名不能为空
        $this->validate($request, [
            'cate_name' => 'required',
        ]);

        $data = $request->except('_token');
        $pid=$request->input("pid");

        //判断添加的是否是顶级分类
        if($pid==0){
            //获取已有顶级分类的数量
            $num = DB::table('category')->where('pid','=',0)->count();

            if($num>=9){
                return back()->with('error',"顶级分类最多只能添加9个!");
            }

            //给path字段赋值
            $data['path']='0';
            //执行添加顶级分类操作
            if(DB::table('category')->insert($data)){
                return redirect('adminx/product_category')->with("success",'分类添加成功');
            }else{
                return back()->with('error',"分类添加失败");
            }
        }else{
            //获取父类的信息
            $info=DB::table('category')->where('cate_id','=',$pid)->first();
            //拼接path
            $data['path']=$info->path.','.$info->cate_id;
            //执行添加子类操作
            if(DB::table('category')->insert($data)){
                return redirect('adminx/product_category')->with("success",'分类添加成功');
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
        //验证分类名不能为空
        $this->validate($request, [
            'cate_name' => 'required',
        ]);

        $update = $request->except("_token","_method");
        
        if(DB::table('category')->where('cate_id','=',$update['cate_id'])->update($update)){
            return back()->with('success',"分类修改成功");
        }else{
            return back()->with('error',"分类修改失败");
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
        //查询删除的分类是否有子分类
        $del = DB::select("SELECT pid FROM category WHERE pid IN ('".$id."')");
        if($del){
            return back()->with('error',"该分类有子类,请先删除子类");
        }else{
            DB::table('category')->where('cate_id','=',$id)->delete();
            return back()->with('success',"分类删除成功");
        }

    }

}

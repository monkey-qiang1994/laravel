<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//导入要调用的模型类
use App\AdminModel\Brand;
class Product_brandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brand = Brand::paginate(5);
        //品牌管理
        return view('admin.product_brand',['brand'=>$brand,'request'=>$request->all()]);
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
        //验证品牌名不能为空
        $this->validate($request, [
            'brand_name' => 'required',
        ]);


        $data = $request->except('_token');
        $brand = Brand::create($data);
        $id = $brand->id;
        if($brand){

            if($request->hasFile('pic')){
                //初始化名字
                $name=time()+rand(1,100000);
                //获取上传文件后缀
                $ext = $request->file("pic")->getClientOriginalExtension();
                //移动到指定的目录下
                $request->file("pic")->move("./uploads/brand",$name.".".$ext);
     
                //把图片的路径存入变量中
                $path = "/uploads/brand/".$name.".".$ext;
                //把上传的图片路径插入到数据表中
                Brand::where('brand_id','=',$id)->update(['brand_img'=>$path]);
            }

            return back()->with("success",'品牌添加成功');
        }else{
            return back()->with("success",'品牌添加失败');
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
        //验证品牌名不能为空
        $this->validate($request, [
            'brand_name' => 'required',
        ]);

        //过滤数据
        $brand = $request->except('_token','_method');

          if($request->hasFile('pic')){

            $info = Brand::where('brand_id','=',$brand['id'])->first();
            //删除原有的图片
            if($info->brand_img != ''){
                unlink('.'.$info->brand_img);
            }

            //初始化名字
            $name=time()+rand(1,100000);
            //获取上传文件后缀
            $ext = $request->file("pic")->getClientOriginalExtension();
            //移动到指定的目录下
            $request->file("pic")->move("./uploads/brand",$name.".".$ext);
 
            //把图片的路径存入变量中
            $path = "/uploads/brand/".$name.".".$ext;
            //把上传的图片路径插入到数据表中
            Brand::where('brand_id','=',$brand['id'])->update(['brand_img'=>$path]);

          
          }

        if($info->brand_name==$brand['brand_name']){
            return back()->with("success",'品牌修改成功');
        }else{
            //插入数据表中
            if(Brand::where('brand_id','=',$brand['id'])->update(['brand_name'=>$brand['brand_name']])){
                return back()->with("success",'品牌修改成功');
            }else{
                return back()->with("error",'品牌修改失败');
            }  
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
        $info = Brand::where('brand_id','=',$id)->first();
        //先删除图片
        if($info->brand_img != ''){
                unlink('.'.$info->brand_img);
                //然后删除数据
                if(Brand::where('brand_id','=',$id)->delete()){
                    return back()->with("success",'删除成功');
                }
            }
        
    }
}

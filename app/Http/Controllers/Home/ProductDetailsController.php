<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ProductDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //获取所有爆款推荐商品放置右侧推荐栏
        $recommend = DB::table('products')
        ->join('products_images','products.product_id','=','products_images.product_id')
        ->select('products.*','products_images.product_img')
        ->where('status','=',1)
        ->groupBy('products.product_id')
        ->get();

        //获取产品信息
        $product = DB::table('products')->where('product_id','=',$id)->first();
        //将产品信息中的属性ID转为数组
        $att_id = explode(',',$product->att_id);
        
        //拿属性表里的att_id去跟产品表中的att_id比对,取出对应的内容
        $att_list = DB::table('attributes')->whereIn('att_id',$att_id)->get();
        //循环从属性表中获取的值,并把值的所属分类id赋值给变量
        foreach($att_list as $att_id){
            $cate_att_id[] = $att_id->cate_att_id;
        }
        //去除数组中的重复元素
        $cate_att_id = array_unique($cate_att_id);

        //通过属性中的分类ID去获取对应分类的内容
        $cate_att = DB::table('cate_attributes')->whereIn('cate_att_id',$cate_att_id)->get();

        //取出跟产品关联的图片信息
        $images = DB::table('products_images')->where('product_id','=',$id)->get();
         //判断该商品是否收藏 收藏显示红心,没收藏白心
        $cang=count(DB::table('shoucang')->where('user_id','=',session('user_id'))->where('product_id','=',$id)->first());

        //获取该商品的评价信息
        $evaluation = DB::table('evaluation_product')
        ->join('homeuser','evaluation_product.user_id','=','homeuser.user_id')
        ->join('user_details','homeuser.user_id','=','user_details.user_id')
        ->where('evaluation_product.product_id','=',$id)
        ->select('evaluation_product.*','homeuser.*','user_details.pic')
        ->get();

        //获取评价信息中为好评的数量
        $haoping = DB::table('evaluation_product')
        ->join('homeuser','evaluation_product.user_id','=','homeuser.user_id')
        ->join('user_details','homeuser.user_id','=','user_details.user_id')
        ->where([['product_id','=',$id],['evaluation_grede','=',0]])
        ->select('evaluation_product.*','homeuser.*','user_details.pic')
        ->get();

        //获取评价信息中为中评的数量
        $zhongping= DB::table('evaluation_product')
        ->join('homeuser','evaluation_product.user_id','=','homeuser.user_id')
        ->join('user_details','homeuser.user_id','=','user_details.user_id')
        ->where([['product_id','=',$id],['evaluation_grede','=',1]])
        ->select('evaluation_product.*','homeuser.*','user_details.pic')
        ->get();

        //获取评价信息中为差评的数量
        $chaping= DB::table('evaluation_product')
        ->join('homeuser','evaluation_product.user_id','=','homeuser.user_id')
        ->join('user_details','homeuser.user_id','=','user_details.user_id')
        ->where([['product_id','=',$id],['evaluation_grede','=',2]])
        ->select('evaluation_product.*','homeuser.*','user_details.pic')
        ->get();

        //获取评价信息的图片
        $evaluation_pic = DB::table('evaluation_pic')->get();

        //获取购物车中的数量
        $cart_num = $this->cart_num();

        //加载模版
        return view('home.product_details',['product'=>$product,'att_list'=>$att_list,'cate_att'=>$cate_att,'images'=>$images,'recommend'=>$recommend,'cart_num'=>$cart_num,'cang'=>$cang,'evaluation'=>$evaluation,'evaluation_pic'=>$evaluation_pic,'haoping'=>$haoping,'zhongping'=>$zhongping,'chaping'=>$chaping]);
    }

    public function addCart(Request $request){
        $data = $request->input('data');

        if($data[0] == null){
            echo 3;exit;
        }


        $add['user_id'] = $data[0];
        $add['product_id'] = $data[1];
        $add['product_num'] = $data[2];

        if(empty($data[3])){
            $add['product_att'] = '尺码:'.$data[4];
        }elseif(empty($data[4])){
            $add['product_att'] = '颜色:'.$data[3];
        }else{
            $add['product_att'] = '颜色:'.$data[3].' 尺码:'.$data[4];
        }


        //获取cart表中已有的数据
        $db = DB::table('cart')->where('user_id','=',$add['user_id'])->get();

        

            //数据可能是多条,所以需要遍历
            foreach($db as $d){
                $product_id[] = $d->product_id;
                $product_att[] = $d->product_att;
            }

        
        //把遍历出来的内容拿来和ajax传过来的内容做比较,
        //如果产品ID和产品属性跟数据表中的某一条值匹配上说明就是在原有的基础上做数量的增加,
        //原有基础上递增我用了increment方法,反之就是添加新产品到cart表中
        if(!$db->isEmpty() and in_array($add['product_id'],$product_id) and in_array($add['product_att'],$product_att)){
           
            if(DB::table('cart')
                ->where([
                    ['product_id','=',$add['product_id']],
                    ['product_att','=',$add['product_att']],
                    ])
                ->increment('product_num',$add['product_num'])
                ){
                echo 1;
            }else{
                echo 2;
            }

        }else{
    
            if(DB::table('cart')->insert($add)){
                echo 1;
            }else{
                echo 2;
            }
        }
            
        
    }
}

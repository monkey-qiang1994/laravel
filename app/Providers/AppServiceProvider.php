<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{

    //获取分类
    public function getCatesByPid($pid){
        $cate = DB::table('category')->where([
            ["pid",'=',$pid],
            ['display','=',0],
            ])->get();
        //遍历
        $data = [];
        foreach($cate as $key=>$value){
            $value->sub=$this->getCatesByPid($value->cate_id);
            $data[]=$value;
        }
        return $data;
    }

    //获取购物车中商品的数量
    public function cart(){
        $cart_num = DB::table('cart')->where('user_id','=',session('user_id',0))->count();
        return $cart_num;
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        //分类信息
        $cate=$this->getCatesBypid(0);
        //视图间共享分类数据
        view()->share('cate',$cate);

        //购物车数据
        $cart_num = $this->cart();
        view()->share('cart_num',$cart_num);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

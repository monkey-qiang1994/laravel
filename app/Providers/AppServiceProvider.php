<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Session;

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

<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //与模型关联的数据表
    protected $table = 'brand';
    //是否自动维护时间戳
    public $timestamps = false;
    //可以被批量赋值的属性
    protected $fillable=['brand_name','brand_img'];
}

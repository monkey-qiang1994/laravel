<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Coupon_send extends Model
{
    //与模型关联的数据表
	protected $table = 'coupon_send';
	//设置主键
	protected $primaryKey="coupon_id";
	//该模型是否被自动维护时间戳
	public $timestamps = false;
	//可以被批量赋值的属性。
	protected $fillable = ['send_id','coupon_id','user_id','coupon_status'];


	public function info()
	{
		return $this->hasOne('App\AdminModel\Coupon','coupon_id');
	}
}

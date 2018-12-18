<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //与模型关联的数据表
	protected $table = 'coupon_make';
	//该模型是否被自动维护时间戳
	public $timestamps = false;
	//主键
	// protected $primaryKey="coupon_id";
	//可以被批量赋值的属性。
	protected $fillable = ['coupon_id','coupon_caption','coupon_down','coupon_price','coupon_time','coupon_num'];

	public function getCouponStatusAttribute($value)
	{
		$coupon_status=[0=>'启用',1=>"过期"];
		return $coupon_status[$value];
	}

	/*public function info()
	{
		return $this->hasOne('App\AdminModel\Coupon_send','coupon_id');
	}*/
}

<?php

namespace App\HomeModel;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //与模型关联的数据表
	protected $table = 'order_list';
	//该模型是否被自动维护时间戳
	public $timestamps = true;
	//主键
	protected $primaryKey="article_id";
	//可以被批量赋值的属性。
	protected $fillable = ['user_id','order_num','order_status'];

	public function getOrderStatusAttribute($value)
	{
		$order_status=[0=>'待支付',1=>"待发货",2=>"待评价",3=>'已完成'];
		return $order_status[$value];
	}
}

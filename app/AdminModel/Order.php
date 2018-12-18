<?php

namespace App\AdminModel;

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
	protected $fillable = ['user_id','order_num','address','phone','order_status'];

	public function getStatusAttribute($value)
	{
		$order_status=[0=>'待付款',1=>"启用",2=>"下架"];
		return $article_status[$value];
	}}

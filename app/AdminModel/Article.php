<?php

namespace App\AdminModel;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //与模型关联的数据表
	protected $table = 'article';
	//该模型是否被自动维护时间戳
	public $timestamps = true;
	//主键
	protected $primaryKey="article_id";
	//可以被批量赋值的属性。
	protected $fillable = ['article_title','article_type','author','article_content','article_status'];

	public function getStatusAttribute($value)
	{
		$article_status=[0=>'待审核',1=>"启用",2=>"下架"];
		return $article_status[$value];
	}

}

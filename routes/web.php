<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/********************前端路由***********************/


//首页
Route::resource('/','Home\IndexController');

//登陆注册页面
Route::resource('/login','Home\LoginController');

//商品列表页面
Route::resource('/list','Home\ProductListController');

//商品内页
Route::resource('/details','Home\ProductDetailsController');

//购物车页面
Route::resource('/cart','Home\CartController');

//结算页面
Route::resource('/pay','Home\PayController');

//联系我们页面
Route::resource('/contact','Home\ContactController');

//个人中心页面 路由组包含填写中间件来绑定用户是否登陆
Route::group(['prefix' => 'user'],function(){
	//欢迎页
	Route::resource('/welcome','Home\User\WelcomeController');
	//个人资料
	Route::resource('/info','Home\User\UserInfoController');
	//收货地址
	Route::resource('/address','Home\User\UserAddressController');
	//优惠卷
	Route::resource('/coupon','Home\User\UserCouponController');
	//修改密码
	Route::resource('/modifypwd','Home\User\ModifyPwdController');
	//我的订单
	Route::resource('/order','Home\User\OrderListController');
	//我的收藏
	Route::resource('/collection','Home\User\UserCollectionController');
	//退货列表
	Route::resource('/return','Home\User\OrderReturnController');
});


/********************后端路由***********************/

Route::group(['prefix'=>'adminx'],function(){
	//主文件
	Route::resource('/','Admin\HomePageController');
	//欢迎界面
	Route::resource('welcomex','Admin\WelcomeController');
	//资讯管理
	Route::resource('/article_list','Admin\Article_listController');
	//图片管理
	Route::resource('/picture_list','Admin\Picture_listController');
	//品牌管理
	Route::resource('/product_brand','Admin\Product_brandController');
	//分类管理
	Route::resource('/product_category','Admin\Product_categoryController');
	//产品管理
	Route::resource('/product_list','Admin\Product_listController');
	//评论列表
	Route::resource('/comment','Admin\CommentController');
	//意见反馈
	Route::resource('/feedback_list','Admin\Feedback_listController');
	//会员列表
	Route::resource('/member_list','Admin\Member_listController');
	//删除的会员
	Route::resource('/member_del','Admin\Member_delController');
	//等级管理
	Route::resource('/membet_level','Admin\Membet_levelController');
	//积分管理
	Route::resource('/member_scoreoperation','Admin\Member_scoreoperationController');
	//浏览记录
	Route::resource('/member_record_browse','Admin\Member_record_browseController');
	//下载记录
	Route::resource('/member_record_download','Admin\Member_record_downloadController');
	//分享记录
	Route::resource('/member_record_share','Admin\Member_record_shareController');
	//管理员列表
	Route::resource('/admin_role','Admin\Admin_roleController');
	//权限管理
	Route::resource('/admin_permission','Admin\Admin_permissionController');
	//管理员列表
	Route::resource('/admin_list','Admin\Admin_listController');
	//系统设置
	Route::resource('/system_base','Admin\System_baseController');
	//栏目管理
	Route::resource('/system_category','Admin\System_categoryController');
	//友情链接
	Route::resource('/links','Admin\LinksController');
	//优惠券管理
	Route::resource('/coupon','Admin\CouponController');

});
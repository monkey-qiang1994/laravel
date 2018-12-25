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
Route::resource('/','Home\IndexController')->middleware('web');

//登陆注册页面
Route::resource('/login','Home\LoginController');

//C提交注册
Route::post('/register','Home\RegisterController@register');
//C测试邮件发送 普通字符串
Route::get("/send","Home\RegisterController@send");
//C测试邮件发送 发送视图
Route::get("/send1","Home\RegisterController@sendMail");
//C验证码测试
Route::get("/code","Home\RegisterController@code");
//C激活
Route::get('/jihuo',"Home\RegisterController@jihuo");
//密码找回
Route::post('/forget',"Home\LoginController@forget");
//C重置密码
Route::get('/reset','Home\LoginController@reset');
//C执行密码重置
Route::post('/doreset','Home\LoginController@doreset');
//C判断手机号是否重复
Route::get('/checkphone','Home\RegisterController@checkphone');

//商品列表页面
Route::resource('/list','Home\ProductListController');

//Q商品内页
Route::get('/details/{id}','Home\ProductDetailsController@index');
//Q商品内页 添加商品到购物车
Route::get('/addCart','Home\ProductDetailsController@addCart');

//Q友情链接页面
Route::resource('/links','Home\LinksController');

//Q新闻资讯页面
Route::resource('/notice','Home\NoticeController');

//购物车页面
Route::resource('/cart','Home\CartController');

//结算页面
Route::resource('/pay','Home\PayController');

//联系我们页面
Route::resource('/contact','Home\ContactController');

//个人中心页面 路由组包含填写中间件来绑定用户是否登陆
Route::group(['prefix' => 'user','middleware'=>'login'],function(){
	//欢迎页
	Route::resource('/welcome','Home\User\WelcomeController');
	//个人资料
	Route::resource('/info','Home\User\UserInfoController');
	//收货地址
	Route::resource('/address','Home\User\UserAddressController');
	//设置默认地址
	Route::get('/moren/{id}','Home\user\UserAddressController@moren');
	//优惠卷
	Route::resource('/coupon','Home\User\UserCouponController');
	//修改密码
	Route::resource('/modifypwd','Home\User\ModifyPwdController');
	//我的收藏
	Route::resource('/collection','Home\User\UserCollectionController');
	//退货列表
	Route::resource('/return','Home\User\OrderReturnController');
	//w订单生成
	Route::resource('/order_pay','Home\Order_payController');
	//w订单内数量改变
	Route::get('/ordernum_change','Home\Order_payController@change');
	//w订单支付
	Route::resource('/order_cart','Home\Order_cartController');
	//w我的订单 
	Route::resource('/my_order','Home\My_orderController');
	//w ajax 查询优惠券信息
	Route::get('/order_coupon','Home\Order_cartController@order_coupon');
	//w 跳转支付宝接口
	Route::get('/alipay','Home\Order_cartController@alipay');
	//w 支付完成跳转路由
	Route::get('/pay_money','Home\Order_cartController@pay_money');
	//w 订单详情
	Route::get('/order_detail','Home\My_orderController@order_detail');
	//w 订单评价'
	Route::get('/order_evaluation','Home\My_orderController@order_evaluation');
	//w 处理订单评价
	Route::post('/process_evaluation','Home\My_orderController@process_evaluation');
	Route::get('/cart_del','Home\Order_payController@cart_del');
});


/********************后端路由***********************/

Route::resource('adminlogin','Admin\AdminloginController');

Route::group(['prefix'=>'adminx','middleware'=>'adminlogin'],function(){
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
	//Q产品状态更新
	Route::post('/product_display','Admin\Product_listController@display');
	//Q产品批量删除
	Route::get('/delall','Admin\Product_listController@delall');
	//Q产品图片删除
	Route::get('/product_img_del','Admin\Product_listController@delete');
	//Q产品属性
	Route::resource('/product_attribute','Admin\Product_attributeController');
	//Q反馈信息
	Route::resource('/contact','Admin\ContactController');
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

	//w公告管理
	Route::resource('/article_list','Admin\Article_listController');
	//w优惠券管理
	Route::resource('/coupon','Admin\CouponController');
	//订单管理
	Route::resource('/order_list','Admin\Order_listController');
	//w订单用户
	Route::get('/order_user','Admin\Order_listController@user');
	//w订单详情
	Route::get('/order_detail','Admin\Order_listController@detail');
	//w评论用户
	Route::get('/comment_user','Admin\CommentController@user');
	//w轮播图管理
	Route::resource('/ads','Admin\AdsController');
	//w审核
	Route::get('/review','Admin\Article_listController@review');
	//w公告详情
	Route::get('/article_detail','Admin\Article_listController@detail');
	//w优惠券生成
	Route::resource('/coupon_make','Admin\Coupon_makeController');
	//w优惠间发送
	Route::get('/coupon_send','Admin\Coupon_makeController@send');
	//w优惠券执行发送
	Route::post('/coupon_dosend','Admin\Coupon_makeController@dosend');
	//w 评论列表
	Route::resource('/comment','Admin\CommentController');
	//w 评论详情
	Route::get('/evaluation','Admin\CommentController@evaluation');

});
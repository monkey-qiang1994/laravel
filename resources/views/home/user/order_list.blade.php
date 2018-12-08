@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
		<!-- 引入侧边栏 -->
			@include('home.layouts.sidebar')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">订单中心-我的订单</div>
					<div class="order-list__box bgf">
						<div class="order-panel">
							<ul class="nav user-nav__title" role="tablist">
								<li role="presentation" class="nav-item active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">所有订单</a></li>
								<li role="presentation" class="nav-item "><a href="#pay" aria-controls="pay" role="tab" data-toggle="tab">待付款 <span class="cr">0</span></a></li>
								<li role="presentation" class="nav-item "><a href="#emit" aria-controls="emit" role="tab" data-toggle="tab">待发货 <span class="cr">0</span></a></li>
								<li role="presentation" class="nav-item "><a href="#take" aria-controls="take" role="tab" data-toggle="tab">待收货 <span class="cr">0</span></a></li>
								<li role="presentation" class="nav-item "><a href="#eval" aria-controls="eval" role="tab" data-toggle="tab">待评价 <span class="cr">0</span></a></li>
							</ul>

							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="all">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">单价</th>
											<th width="85">数量</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">等待付款</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="udai_shopcart_pay.html" class="but but-primary">立即付款</a>
												<!-- <a href="" class="but but-link">评价</a> -->
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">等待收货</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="udai_order_receipted.html" class="but but-primary">确认收货</a>
												<!-- <a href="" class="but but-link">评价</a> -->
												<a href="udai_apply_return.html" class="but c3">退款/退货</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a class="" href="">下一页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="pay">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">单价</th>
											<th width="85">数量</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
									</table>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="emit">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">单价</th>
											<th width="85">数量</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">等待发货</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="udai_order_receipted.html" class="but but-primary">确认收货</a>
												<a href="udai_apply_return.html" class="but c3">退款/退货</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">等待发货</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="udai_order_receipted.html" class="but but-primary">确认收货</a>
												<a href="udai_apply_return.html" class="but c3">退款/退货</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">等待发货</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="udai_order_receipted.html" class="but but-primary">确认收货</a>
												<a href="udai_apply_return.html" class="but c3">退款/退货</a>
											</td>
										</tr>
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a class="disabled">下一页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="take">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">单价</th>
											<th width="85">数量</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
									</table>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="eval">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">单价</th>
											<th width="85">数量</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														2017-03-30 订单号: 2669901385864042
													</a>
													<div class="card">
														<div class="img"><img src="/home/images/temp/item-img_1.jpg" alt="" class="cover"></div>
														<div class="name ep2">纯色圆领短袖T恤活动衫弹力柔软纯色圆领短袖T恤</div>
														<div class="format">颜色分类：深棕色  尺码：均码</div>
														<div class="favour">使用优惠券：优惠¥2.00</div>
													</div>
												</label>
											</td>
											<td>￥100</td>
											<td>1</td>
											<td>￥1000<br><span class="fz12 c6 text-nowrap">(含运费: ¥0.00)</span></td>
											<td class="state">
												<a class="but c6">交易成功</a>
												<a href="udai_mail_query.html" class="but cr">查看物流</a>
												<a href="udai_order_detail.html" class="but c9">订单详情</a>
											</td>
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												<a href="" class="but but-link">评价</a>
												<a href="" class="but c3">取消订单</a>
											</td>
										</tr>
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a class="disabled">下一页</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</section>
	</div>
	@endsection
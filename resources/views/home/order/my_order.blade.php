@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
@section('main')
	<style>
		input[type="radio"]{
			display: none;
		}

		.savetips{
			width: 220px;
			height: 50px;
			border-radius: 20px;
			background: #454545;
			font-size: 16px;
			font-family: 'Montserrat', sans-serif;
			font-weight: bold;
			text-align: center;
			line-height: 50px;
        	position: fixed;
        	top:50%;
        	left: calc(50% - 110px);
        	color: #fff;}
	</style>
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
								<!-- 所用订单 -->
								<div role="tabpanel" class="tab-pane fade in active" id="all">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">商品数量</th>
											<th width="120">应付款</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										@if(!$all->isEmpty())
										@foreach($all as $all_v)
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														{{Date('Y-m-d',$all_v->created_at)}} 订单号: {{$all_v->order_num}}
													</a>
													<div class="card">
													
														<div class="name ep2">地址</div>
														<div class="format">订单支付时间:{{Date('Y-m-d',$all_v->pay_at)}}</div>
														
													</div>
												</label>
											</td>
											<td>{{$all_v->num}}</td>
											<td>￥{{$all_v->total}}</td>
											<td>￥@if(!empty($all_v->payable)){{$all_v->payable}}
												@else
												{{$all_v->total}}
												@endif
												<br><span class="fz12 c6 text-nowrap">
											@if($all_v->coupon_id != 0)
											@foreach($coupon as $coupon_v)
											@if($coupon_v->coupon_id == $all_v->coupon_id)
											(优惠券抵扣: ¥{{$coupon_v->coupon_price}})
											@endif
											@endforeach
											@endif
											</span></td>
											@if($all_v->order_status == 0)
											<td class="state">
												<a href="/user/alipay?order_id={{$all_v->order_id}}" class="but c6">等待付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}"  class="but c9">订单详情</a>
											</td>
											@endif
											@if($all_v->order_status == 1 || $all_v->order_status == 2 )
											<td class="state">
												<a class="but c6">已付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}" class="but c9">订单详情</a>
											</td>
											@endif
											@if($all_v->order_status == -1)
											<td class="state">
												<a class="but c6">已取消</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}" class="but c9">订单详情</a>
											</td>
											@endif
											@if($all_v->order_status >= 3)
											<td class="state">
												<a class="but c6">已完成</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}" class="but c9">订单详情</a>
											</td>
											@endif
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												@if($all_v->order_status == 0)
												<a href="" class="but but-primary">
													立即付款</a>
												<a href="" class="but c3">取消订单</a>
												@endif
												@if($all_v->order_status == 1)
												<a href="" class="but but-primary">
													待发货</a>
												<a href="" class="but c3">取消订单</a>

												@endif
												@if($all_v->order_status == 2)
												<a href="" class="but but-primary">
													确认收货</a>
												<a href="" class="but c3">退款/退货</a>

												@endif
												@if($all_v->order_status == 3)
												<a href="/user/order_evaluation?id={{$all_v->order_id}}" class="but but-primary">
													评价</a>

												@endif
												@if($all_v->order_status == 4)
												<a href="javascript:void(0)" class="but but-primary">
													已完成</a>

												@endif
												<!-- <a href="" class="but but-link">评价</a> -->
												
											</td>
										</tr>
										@endforeach
										@else
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
										@endif
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a class="" href="">下一页</a>
									</div>
								</div>
								<!-- 所有订单end -->
								<!-- 代付款订单start -->
								<div role="tabpanel" class="tab-pane fade" id="pay">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">商品数量</th>
											<th width="120">应付款</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										@foreach($all as $all_v)
										@if(!$all->isEmpty() && $all_v->order_status ==0)
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														{{Date('Y-m-d',$all_v->created_at)}} 订单号: {{$all_v->order_num}}
													</a>
													<div class="card">
													
														<div class="name ep2">地址</div>
														<div class="format">订单支付时间:{{Date('Y-m-d',$all_v->pay_at)}}</div>
														
													</div>
												</label>
											</td>
											<td>{{$all_v->num}}</td>
											<td>￥{{$all_v->total}}</td>
											<td>￥@if(!empty($all_v->payable)){{$all_v->payable}}
												@else
												{{$all_v->total}}
												@endif
												<br><span class="fz12 c6 text-nowrap">
											@if($all_v->coupon_id != 0)
											@foreach($coupon as $coupon_v)
											@if($coupon_v->coupon_id == $all_v->coupon_id)
											(优惠券抵扣: ¥{{$coupon_v->coupon_price}})
											@endif
											@endforeach
											@endif
											</span></td>
											@if($all_v->order_status == 0)
											<td class="state">
												<a href="/user/alipay?order_id={{$all_v->order_id}}" class="but c6">等待付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}"  class="but c9">订单详情</a>
											</td>
											@endif
											@if($all_v->order_status == 1 || $all_v->order_status == 2 )
											<td class="state">
												<a class="but c6">已付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}" class="but c9">订单详情</a>
											</td>
											@endif
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												@if($all_v->order_status == 0)
												<a href="" class="but but-primary">
													立即付款</a>
												<a href="" class="but c3">取消订单</a>
												@endif
												@if($all_v->order_status == 1)
												<a href="" class="but but-primary">
													待发货</a>
												<a href="" class="but c3">取消订单</a>

												@endif
												@if($all_v->order_status == 2)
												<a href="" class="but but-primary">
													确认收货</a>
												<a href="" class="but c3">退款/退货</a>

												@endif
												@if($all_v->order_status == 3)
												<a href="/user/order_evaluation?id={{$all_v->order_id}}" class="but but-primary">
													评价</a>

												@endif
												<!-- <a href="" class="but but-link">评价</a> -->
												
											</td>
										</tr>

										@endif

										@endforeach
							
										@if(!$all->isEmpty() && empty($all_v->order_status == 0))
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
										@endif	
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a class="" href="">下一页</a>
									</div>
								</div>
								<!-- 待付款订单end -->
								<!-- 代发货订单start -->
								<div role="tabpanel" class="tab-pane fade" id="emit">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">商品数量</th>
											<th width="120">应付款</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										@foreach($all as $all_v)
										@if(!empty($all_v) && $all_v->order_status ==1)
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														{{Date('Y-m-d',$all_v->created_at)}} 订单号: {{$all_v->order_num}}
													</a>
													<div class="card">
													
														<div class="name ep2">地址</div>
														<div class="format">订单支付时间:{{Date('Y-m-d',$all_v->pay_at)}}</div>
														
													</div>
												</label>
											</td>
											<td>{{$all_v->num}}</td>
											<td>￥{{$all_v->total}}</td>
											<td>￥@if(!empty($all_v->payable)){{$all_v->payable}}
												@else
												{{$all_v->total}}
												@endif
												<br><span class="fz12 c6 text-nowrap">
											@if($all_v->coupon_id != 0)
											@foreach($coupon as $coupon_v)
											@if($coupon_v->coupon_id == $all_v->coupon_id)
											(优惠券抵扣: ¥{{$coupon_v->coupon_price}})
											@endif
											@endforeach
											@endif
											</span></td>
											@if($all_v->order_status == 0)
											<td class="state">
												<a href="/user/alipay?order_id={{$all_v->order_id}}" class="but c6">等待付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}"  class="but c9">订单详情</a>
											</td>
											@endif
											@if($all_v->order_status == 1 || $all_v->order_status == 2 )
											<td class="state">
												<a class="but c6">已付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}" class="but c9">订单详情</a>
											</td>
											@endif
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												@if($all_v->order_status == 0)
												<a href="" class="but but-primary">
													立即付款</a>
												<a href="" class="but c3">取消订单</a>
												@endif
												@if($all_v->order_status == 1)
												<a href="" class="but but-primary">
													待发货</a>
												<a href="" class="but c3">取消订单</a>

												@endif
												@if($all_v->order_status == 2)
												<a href="" class="but but-primary">
													确认收货</a>
												<a href="" class="but c3">退款/退货</a>

												@endif
												@if($all_v->order_status == 3)
												<a href="/user/order_evaluation?id={{$all_v->order_id}}" class="but but-primary">
													评价</a>

												@endif
												<!-- <a href="" class="but but-link">评价</a> -->
												
											</td>
										</tr>
										@endif

										@endforeach
								

										@if( !$all->isEmpty() && empty($all_v->order_status == 1))
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
										@endif
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a class="" href="">下一页</a>
									</div>
								</div>
								<!-- 待付款发货end -->
								<!-- 待收货start -->
								<div role="tabpanel" class="tab-pane fade" id="take">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">商品数量</th>
											<th width="120">应付款</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										@foreach($all as $all_v)
										@if(!empty($all_v) && $all_v->order_status ==2)
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														{{Date('Y-m-d',$all_v->created_at)}} 订单号: {{$all_v->order_num}}
													</a>
													<div class="card">
													
														<div class="name ep2">地址</div>
														<div class="format">订单支付时间:{{Date('Y-m-d',$all_v->pay_at)}}</div>
														
													</div>
												</label>
											</td>
											<td>{{$all_v->num}}</td>
											<td>￥{{$all_v->total}}</td>
											<td>￥@if(!empty($all_v->payable)){{$all_v->payable}}
												@else
												{{$all_v->total}}
												@endif
												<br><span class="fz12 c6 text-nowrap">
											@if($all_v->coupon_id != 0)
											@foreach($coupon as $coupon_v)
											@if($coupon_v->coupon_id == $all_v->coupon_id)
											(优惠券抵扣: ¥{{$coupon_v->coupon_price}})
											@endif
											@endforeach
											@endif
											</span></td>
											@if($all_v->order_status == 0)
											<td class="state">
												<a href="/user/alipay?order_id={{$all_v->order_id}}" class="but c6">等待付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}"  class="but c9">订单详情</a>
											</td>
											@endif
											@if($all_v->order_status == 1 || $all_v->order_status == 2 )
											<td class="state">
												<a class="but c6">已付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}" class="but c9">订单详情</a>
											</td>
											@endif
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												@if($all_v->order_status == 0)
												<a href="" class="but but-primary">
													立即付款</a>
												<a href="" class="but c3">取消订单</a>
												@endif
												@if($all_v->order_status == 1)
												<a href="" class="but but-primary">
													待发货</a>
												<a href="" class="but c3">取消订单</a>

												@endif
												@if($all_v->order_status == 2)
												<a href="" class="but but-primary">
													确认收货</a>
												<a href="" class="but c3">退款/退货</a>

												@endif
												@if($all_v->order_status == 3)
												<a href="/user/order_evaluation?id={{$all_v->order_id}}" class="but but-primary">
													评价</a>

												@endif
												<!-- <a href="" class="but but-link">评价</a> -->
												
											</td>
										</tr>
										@endif

										@endforeach
										@if(!$all->isEmpty() && empty($all_v->order_status == 2))
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
										@endif
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a class="" href="">下一页</a>
									</div>
								</div>
								<!-- 待收货end -->
								<!-- 待评价start -->
								<div role="tabpanel" class="tab-pane fade" id="eval">
									<table class="table text-center">
										<tr>
											<th width="380">商品信息</th>
											<th width="85">商品数量</th>
											<th width="120">应付款</th>
											<th width="120">实付款</th>
											<th width="120">交易状态</th>
											<th width="120">交易操作</th>
										</tr>
										@foreach($all as $all_v)
										@if(!empty($all_v) && $all_v->order_status ==3)
										<tr class="order-item">
											<td>
												<label>
													<a href="udai_order_detail.html" class="num">
														{{Date('Y-m-d',$all_v->created_at)}} 订单号: {{$all_v->order_num}}
													</a>
													<div class="card">
													
														<div class="name ep2">地址</div>
														<div class="format">订单支付时间:{{Date('Y-m-d',$all_v->pay_at)}}</div>
														
													</div>
												</label>
											</td>
											<td>{{$all_v->num}}</td>
											<td>￥{{$all_v->total}}</td>
											<td>￥@if(!empty($all_v->payable)){{$all_v->payable}}
												@else
												{{$all_v->total}}
												@endif
												<br><span class="fz12 c6 text-nowrap">
											@if($all_v->coupon_id != 0)
											@foreach($coupon as $coupon_v)
											@if($coupon_v->coupon_id == $all_v->coupon_id)
											(优惠券抵扣: ¥{{$coupon_v->coupon_price}})
											@endif
											@endforeach
											@endif
											</span></td>
											@if($all_v->order_status == 0)
											<td class="state">
												<a href="/user/alipay?order_id={{$all_v->order_id}}" class="but c6">等待付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}"  class="but c9">订单详情</a>
											</td>
											@endif
											@if($all_v->order_status == 1 || $all_v->order_status == 2 )
											<td class="state">
												<a class="but c6">已付款</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}" class="but c9">订单详情</a>
											</td>
											@endif
											@if($all_v->order_status >= 3)
											<td class="state">
												<a class="but c6">已完成</a>
												<a href="/user/order_detail?order_id={{$all_v->order_id}}" class="but c9">订单详情</a>
											</td>
											@endif
											<td class="order">
												<div class="del"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></div>
												@if($all_v->order_status == 0)
												<a href="" class="but but-primary">
													立即付款</a>
												<a href="" class="but c3">取消订单</a>
												@endif
												@if($all_v->order_status == 1)
												<a href="" class="but but-primary">
													待发货</a>
												<a href="" class="but c3">取消订单</a>

												@endif
												@if($all_v->order_status == 2)
												<a href="" class="but but-primary">
													确认收货</a>
												<a href="" class="but c3">退款/退货</a>

												@endif
												@if($all_v->order_status == 3)
												<a href="/user/order_evaluation?id={{$all_v->order_id}}" class="but but-primary">
													评价</a>

												@endif
												@if($all_v->order_status == 4)
												<a href="/user/order_evaluation?id={{$all_v->order_id}}" class="but but-primary">
													已完成</a>

												@endif
												<!-- <a href="" class="but but-link">评价</a> -->
												
											</td>
										</tr>
										@endif

										@endforeach
										@if( !$all->isEmpty() && empty($all_v->order_status == 3))
										<tr class="order-empty"><td colspan='6'>
											<div class="empty-msg">最近没有任何订单，家里好像缺了点什么！<br><a href="item_category.html">要不瞧瞧去？</a></div>
										</td></tr>
										@endif
									</table>
									<div class="page text-right clearfix" style="margin-top: 40px">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a class="" href="">下一页</a>
									</div>
								</div>
								<!-- 待评价end -->
							</div>
						</div>
					</div>
				
				</div>
			</div>
		</section>
   		@if(Session::has('success'))
		<div id="addBox" class="savetips success"  >{{Session::get('success')}}</div>
		@endif
   		@if(Session::has('error'))
		<div id="addBox" class="savetips success"  >{{Session::get('error')}}</div>
		@endif
	</div>
	<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
	<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
	<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
	<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

	<!--请在下方写此页面业务相关的脚本-->
	<script type="text/javascript" src="../admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
	<script type="text/javascript" src="../admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
	<script type="text/javascript" src="../admin/lib/laypage/1.2/laypage.js"></script>
	<script type="text/javascript">
		 //提示信息
		  var success = $('.success').html();
		  function modaldemo(){
		  $("#modal-demo").modal("show")}
		      function modalalertdemo(){
		      $.Huimodalalert(success,1000)}
		  if (success) {
		    modalalertdemo();
		  }
		  //提示信息
		  var success = $('.error').html();
		  function modaldemo(){
		  $("#modal-demo").modal("show")}
		      function modalalertdemo(){
		      $.Huimodalalert(success,1000)}
		  if (success) {
		    modalalertdemo();
		  }
	</script>
	@endsection
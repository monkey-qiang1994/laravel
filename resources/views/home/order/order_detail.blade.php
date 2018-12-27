@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
@section('main')
<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
		<!-- 引入侧边栏 -->
			@include('home.layouts.sidebar')			
			<div class="pull-right">
				@foreach($address as $order_v)
				<div class="user-content__box clearfix bgf">
					<div class="title">订单中心-订单{{$order_v->order_num}}</div>
					<div class="order-info__box">
						
						<div class="order-addr">收货地址：
							<br/>
							<b>收货人:</b> {{$order_v->consignee}} &nbsp;|&nbsp; <b>联系电话: </b>{{$order_v->phone}}
							<br/>
							<b>省份:</b> {{$order_v->province}} &nbsp;|&nbsp; <b>城市: </b>{{$order_v->city}}
							<br/>
							<b>详细地址:</b> {{$order_v->area}},{{$order_v->town}},{{$order_v->address}}
							<hr/>
						</div>
						
						<div class="order-info">
							订单信息
							<table>
								<tbody><tr>
									<td>创建时间：{{Date('Y-m-d H:i:s',$order_v->created_at)}}</td>
									<td></td>
									<td>成交时间：{{Date('Y-m-d H:i:s',$order_v->pay_at)}}</td>
								</tr>
								<tr>
									<td>订单编号：{{$order_v->order_num}}</td>
									<td></td>
								</tr>
							</tbody></table>
						</div>
						@endforeach
						<div class="table-thead">
							<div class="tdf3">商品</div>
							<div class="tdf1">数量</div>
							<div class="tdf1">单价</div>
							<div class="tdf1">合计</div>
							<div class="tdf1">评价</div>
						</div>
						@foreach($detail as $detail_v)
						<div class="order-item__list">
							<div class="item">
								<div class="tdf3">
									<a href="/details/{{$detail_v->product_id}}"><div class="img"><img src="{{$detail_v->product_img}}" class="cover"></div>
									<div class="ep2 c6">{{$detail_v->product_name}}</div></a>
									<div class="attr ep">{{$detail_v->product_attr}}</div>
								</div>
								<div class="tdf1">{{$detail_v->product_num}}</div>
								<div class="tdf1">¥{{$detail_v->product_price}}</div>
								<div class="tdf1">¥{{$detail_v->product_num*$detail_v->product_price}}</div>
								<div class="tdf1">
									@if($detail_v->evaluation_status == 0)
									<a href="/user/order_evaluation?id={{$detail_v->order_id}}&product_id={{$detail_v->product_id}}">去评价</a>
									@else
									<a href="/">已评价</a>
									@endif
								</div>
							</div>
						</div>
						@endforeach
						@foreach($coupon as $coupon_v)
						<div class="price-total">
							<div class="fz12 c9">@if(isset($coupon_v->coupon_price))使用优惠券【满￥{{$coupon_v->coupon_down}}减￥{{$coupon_v->coupon_price}}】优惠￥{{$coupon_v->coupon_price}}元
							@else
							不使用优惠券
							@endif
						</div>
							<div class="fz18 c6" style="font-size: 16px">总价：<b class="cr" style="color: #12242e">¥
								{{$coupon_v->total}}
								</b></div><br>
							<div class="fz18 c6">实付款：<b class="cr">¥
								@if(empty($coupon_v->payable))
								{{$coupon_v->total}}
								@else
								{{$coupon_v->payable}}
								@endif</b></div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
	@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<!-- 引入侧边栏 -->
			@include('home.layouts.sidebar')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">账户信息-积分平台</div>
					<ul class="nav user-nav__title" role="tablist">
						<li role="presentation" class="nav-item active"><a href="#useful" aria-controls="useful" role="tab" data-toggle="tab">未使用</a></li>
						<li role="presentation" class="nav-item "><a href="#used" aria-controls="used" role="tab" data-toggle="tab">已使用</a></li>

					</ul>
					
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="useful">
							<div class="coupon-list" style="position: relative;">
								@if(!$coupon->isEmpty())
								@forelse($coupon as $coupon_v)
								@if($coupon_v->coupon_status == 1)
								<div class="coupon">
									<div class="coupon-hd"><b><small class="fz16">¥</small>{{$coupon_v->coupon_price}}</b><div class="fz12">【过期时间】<br>{{Date('Y-m-d H:i:s',$coupon_v->coupon_time)}}</div></div>
									<div class="coupon-bd"><div class="fz12 c9">券号：{{$coupon_v->coupon_caption}}</div><div class="fz12 c9">规则： 消费需满{{$coupon_v->coupon_down}}元</div></div>
									<a href="/" class="coupon-ft">立即使用</a>
								</div>
								@endif
								@empty
								<div class="coupon-list">
									<div class="empty-msg">哇，居然没有优惠券了？</div>
								</div>
								@endforelse
								@endif
	

								<div class="page text-right clearfix" style="position: absolute;bottom: -33;right: 0px;">
									<a class="disabled">上一页</a>
									<a class="select">1</a>
									<a href="">2</a>
									<a href="">3</a>
									<a class="" href="">下一页</a>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane fade" id="used">
							<div class="coupon-list" style="position: relative;">
								@if(!$coupon->isEmpty())
								@forelse($coupon as $coupon_v)
								@if($coupon_v->coupon_status == 1)
								<div class="coupon">
									<div class="coupon-hd"><b><small class="fz16">¥</small>{{$coupon_v->coupon_price}}</b><div class="fz12">【过期时间】<br>{{Date('Y-m-d H:i:s',$coupon_v->coupon_time)}}</div></div>
									<div class="coupon-bd"><div class="fz12 c9">券号：{{$coupon_v->coupon_caption}}</div><div class="fz12 c9">规则： 消费需满{{$coupon_v->coupon_down}}元</div></div>
									<a href="/" class="coupon-ft">立即使用</a>
								</div>
								@endif
								@empty
								<div class="coupon-list">
									<div class="empty-msg">哇，居然没有优惠券了？</div>
								</div>
								@endforelse
								@endif
	
							<div class="page text-right clearfix" style="position: absolute;bottom: -33;right: 0px;">
								<a class="disabled">上一页</a>
								<a class="select">1</a>
								<a href="">2</a>
								<a href="">3</a>
								<a class="" href="">下一页</a>
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
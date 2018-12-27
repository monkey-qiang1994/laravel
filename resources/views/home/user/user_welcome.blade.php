@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
@section('main')
	
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
		<!-- 引入侧边菜单 -->
			@include('home.layouts.sidebar')
			<div class="pull-right">
				@if(session('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>	
						{{session('success')}}</div>
				@elseif(session('error'))
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{session('error')}}</div>
				@endif
				<div class="user-center__info bgf">
					<div class="pull-left clearfix">
						<div class="port b-r50 pull-left">
						@if($da==1)
							<img src="{{$data[0]}}" alt="" class="cover b-r50">
						@else	
							<img src="/uploads/img_logged_in.png" class="cover b-r50" alt="">
						@endif
							<a href="/user/info/31/edit" class="edit"><i class="iconfont icon-edit"></i></a>
						</div>
						<p class="name text-nowrap">您好，{{$info[0]}}</p>
						<p class="money text-nowrap"><a href="/user/info/{{session('user_id')}}/edit">修改个人信息</a></p>
						<p class="level text-nowrap"><a href="/user/modifypwd">修改登录信息</a></p>
					</div>
					<div class="pull-right user-nav">
						<a href="/user/my_order" class="user-nav__but">
							<i class="iconfont icon-rmb fz40 cr"></i>
							<div class="c6">待支付 <span class="cr">{{count($order)}}</span></div>
						</a>
						<a href="/user/my_order" class="user-nav__but">
							<i class="iconfont icon-eval fz40 cr"></i>
							<div class="c6">待评价 <span class="c3">{{count($evaluation)}}</span></div>
						</a>
						<a href="/user/collection" class="user-nav__but">
							<i class="iconfont icon-star fz40 cr"></i>
							<div class="c6">收藏 <span class="c3">{{count($shoucang)}}</span></div>
						</a>
						<a href="/user/coupon" class="user-nav__but">
							<i class="iconfont icon-quan fz40 cr"></i>
							<div class="c6">优惠券 <span class="cr">{{count($coupon)}}</span></div>
						</a>
					</div>
				</div>
				<div class="order-list__div bgf">
					<img src="/uploads/slider/2.png" width="100%">
				</div>
				<div class="recommends">
					<div class="lace-title type-2">
						<span class="cr">新品推荐</span>
					</div>
					<div class="swiper-container recommends-swiper">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								@foreach($news as $new)
								<a class="picked-item" href="/details/{{$new->product_id}}">
									<img src="{{$new->product_img}}" class="cover">
									<div class="look_price">{{$new->price}}</div>
								</a>
								@endforeach
							</div>

						</div>
					</div>
					<script>
						$(document).ready(function(){
							var recommends = new Swiper('.recommends-swiper', {
								spaceBetween : 40,
								autoplay : 5000,
							});
						});
					</script>
				</div>
			</div>
		</section>
	</div>
	@endsection
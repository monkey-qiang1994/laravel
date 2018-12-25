	<!-- 继承模版 -->
	@extends('home.layouts.public')
	<title>@yield('title',"服装商城")</title>

			@section('main')

		
	<!-- 顶部轮播 -->
    <div class="swiper-container banner-box">
        <div class="swiper-wrapper">
        	@foreach($slider as $slide)
            <div class="swiper-slide"><a href="#"><img src="/uploads/slider/{{$slide->ads_path}}" class="cover"></a></div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>

	<!-- 楼层内容 -->
	<div class="content inner" style="margin-bottom: 40px;">
		<section class="scroll-floor floor-1 clearfix">
			<div class="pull-left">
				<div class="floor-title">
					<i class="iconfont icon-tuijian fz16"></i> 爆款推荐
					<a href="" class="more"><i class="iconfont icon-more"></i></a>
				</div>
				<div class="con-box">
					<a class="left-img hot-img" href="">
					@foreach($ads as $a)
						@if($a->ads_position == 2)
						<img src="/uploads/slider/{{$a->ads_path}}" class="cover">
						@endif
					@endforeach
					</a>
					<div class="right-box hot-box">
					@foreach($recommend as $row)
						<a href="/details/{{$row->product_id}}" class="floor-item">
							<div class="item-img hot-img">
								<img src="{{$row->product_img}}" alt="{{$row->product_name}}" class="cover">
							</div>
							<div class="price clearfix">
								<span class="pull-left cr fz16">
								&yen; @if($row->discount_price)
								{{$row->discount_price}} <s class="fz16 c9">{{$row->price}}</s>
								@else
								{{$row->price}}
								@endif
								</span>
								<span class="pull-right c6">{{$row->brand_name}}</span>
							</div>
							<div class="name ep" title="{{$row->product_name}}">{{$row->product_name}}</div>
						</a>
					@endforeach
					</div>
				</div>
			</div>
			<div class="pull-right">
				<div class="floor-title">
					<i class="iconfont icon-horn fz16"></i> 平台公告
					<a href="/notice" class="more"><i class="iconfont icon-more"></i></a>
				</div>
				<div class="con-box">
					<div class="notice-box bgf5">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								@foreach($article as $list)
								<a class="swiper-slide ep" href="http://www.laravel.com/notice?id={{$list->article_id}}">【@if($list->article_type == 1) 新闻 @else 公告 @endif】{{$list->article_title}}</a>
								@endforeach
							</div>
						</div>
					</div>
					<div class="buts-box bgf5">
						<div class="but-div">
							<a href="#">
								<i class="but-icon"></i>
								<p>物流查询</p>
							</a>
						</div>
						<div class="but-div">
							<a href="#">
								<i class="but-icon"></i>
								<p>热卖专区</p>
							</a>
						</div>
						<div class="but-div">
							<a href="#">
								<i class="but-icon"></i>
								<p>满减专区</p>
							</a>
						</div>
						<div class="but-div">
							<a href="#">
								<i class="but-icon"></i>
								<p>折扣专区</p>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-2">
			<div class="floor-title">
				<i class="iconfont icon-xiaoxi fz16"></i> 新品直达
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="">
					@foreach($ads as $a)
						@if($a->ads_position == 3)
						<img src="/uploads/slider/{{$a->ads_path}}" class="cover">
						@endif
					@endforeach
				</a>
				<div class="right-box">

					@foreach($news as $new)
					<a href="/details/{{$new->product_id}}" class="floor-item">
						<div class="item-img hot-img">
							<img src="{{$new->product_img}}" alt="{{$new->product_name}}" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">
								&yen; @if($new->discount_price)
								{{$new->discount_price}} <s class="fz16 c9">{{$new->price}}</s>
								@else
								{{$new->price}}
								@endif
							</span>
							<span class="pull-right c6">{{$new->brand_name}}</span>
						</div>
						<div class="name ep" title="{{$new->product_name}}">{{$new->product_name}}</div>
					</a>
					@endforeach
			
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-3">
			<div class="floor-title">
				<i class="iconfont icon-star fz16"></i> 畅销热卖

			</div>
			<div class="con-box">
			
				<a class="left-img hot-img" href="">
					@foreach($ads as $a)
						@if($a->ads_position == 4)
						<img src="/uploads/slider/{{$a->ads_path}}" class="cover">
						@endif
					@endforeach
				</a>

				<div class="right-box">

					@foreach($popular as $pop)
					<a href="/details/{{$pop->product_id}}" class="floor-item">
						<div class="item-img hot-img">
							<img src="{{$pop->product_img}}" alt="{{$pop->product_name}}" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">
								&yen; @if($pop->discount_price)
								{{$pop->discount_price}} <s class="fz16 c9">{{$pop->price}}</s>
								@else
								{{$pop->price}}
								@endif
							</span>
							<span class="pull-right c6">{{$pop->brand_name}}</span>
						</div>
						<div class="name ep" title="{{$pop->product_name}}">{{$pop->product_name}}</div>
					</a>
					@endforeach
					
				</div>
			</div>
		</section>
		<section class="scroll-floor floor-4">
			<div class="floor-title">
				<i class="iconfont icon-rmb fz16"></i> 优惠特价
			</div>
			<div class="con-box">
				<a class="left-img hot-img" href="">
					@foreach($ads as $a)
						@if($a->ads_position == 5)
						<img src="/uploads/slider/{{$a->ads_path}}" class="cover">
						@endif
					@endforeach
				</a>
				<div class="right-box">

					@foreach($discount as $dis)
					<a href="/details/{{$dis->product_id}}" class="floor-item">
						<div class="item-img hot-img">
							<img src="{{$dis->product_img}}" alt="{{$dis->product_name}}" class="cover">
						</div>
						<div class="price clearfix">
							<span class="pull-left cr fz16">
								&yen; @if($dis->discount_price)
								{{$dis->discount_price}} <s class="fz16 c9">{{$dis->price}}</s>
								@else
								{{$dis->price}}
								@endif
							</span>
							<span class="pull-right c6">{{$dis->brand_name}}</span>
						</div>
						<div class="name ep" title="{{$dis->product_name}}">{{$dis->product_name}}</div>
					</a>
					@endforeach

				</div>
			</div>
		</section>

	</div>
	<script>
		$(document).ready(function(){ 
			// 顶部banner轮播
			var banner_swiper = new Swiper('.banner-box', {
				autoplayDisableOnInteraction : false,
				pagination: '.banner-box .swiper-pagination',
				paginationClickable: true,
				autoplay : 5000,
			});
			// 新闻列表滚动
			var notice_swiper = new Swiper('.notice-box .swiper-container', {
				paginationClickable: true,
				mousewheelControl : true,
				direction : 'vertical',
				slidesPerView : 10,
				autoplay : 2e3,
			});

			// 页面下拉固定楼层导航
			$('.floor-nav').smartFloat();
			$('.to-top').toTop({position:false});
		});
	</script>
	
	<!-- 右侧菜单 -->
	<div class="right-nav">
		<ul class="r-with-gotop">
			<li class="r-toolbar-item">
				<a href="user/welcome" class="r-item-hd">
					<i class="iconfont icon-user"></i>
					<div class="r-tip__box"><span class="r-tip-text">用户中心</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="cart" class="r-item-hd">
					<i class="iconfont icon-cart" data-badge="{{$cart_num}}"></i>
					<div class="r-tip__box"><span class="r-tip-text">购物车</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="user/collection" class="r-item-hd">
					<i class="iconfont icon-aixin"></i>
					<div class="r-tip__box"><span class="r-tip-text">我的收藏</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="contact" class="r-item-hd">
					<i class="iconfont icon-liuyan"></i>
					<div class="r-tip__box"><span class="r-tip-text">留言反馈</span></div>
				</a>
			</li>
			<li class="r-toolbar-item to-top">
				<i class="iconfont icon-top"></i>
				<div class="r-tip__box"><span class="r-tip-text">返回顶部</span></div>
			</li>
		</ul>
		<script>
			$(document).ready(function(){ $('.to-top').toTop({position:false}) });
		</script>
	</div>

	
	@endsection
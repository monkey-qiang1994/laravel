	<!-- 继承模版 -->
	@extends('home.layouts.public')
	<title>@yield('title',"服装商城")</title>

			@section('main')

		
	<!-- 顶部轮播 -->
    <div class="swiper-container banner-box">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="item_show.html"><img src="/home/images/temp/banner_1.jpg" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_show.html"><img src="/home/images/temp/banner_2.jpg" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_category.html"><img src="/home/images/temp/banner_3.jpg" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_show.html"><img src="/home/images/temp/banner_4.jpg" class="cover"></a></div>
            <div class="swiper-slide"><a href="item_sale_page.html"><img src="/home/images/temp/banner_5.jpg" class="cover"></a></div>
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
						<img src="/home/images/floor_1.jpg" alt="" class="cover">
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
					<a href="udai_notice.html" class="more"><i class="iconfont icon-more"></i></a>
				</div>
				<div class="con-box">
					<div class="notice-box bgf5">
						<div class="swiper-container">
							<div class="swiper-wrapper">
								<a class="swiper-slide ep" href="udai_notice.html">【公告】U袋网平台已上线，您还在等什么呢？是吧~</a>
								<a class="swiper-slide ep" href="udai_notice.html">【资讯】P站服务器爆炸啦。国内86%地区IP被限制~</a>
								<a class="swiper-slide ep" href="udai_notice.html">【公告】六趣公司9月底将彻底关闭66RPG论坛~</a>
								<a class="swiper-slide ep" href="udai_notice.html">【资讯】Project1站将接盘66RPG，新域名rpg.blue</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】央行决定对普惠金融实施定向降准政策 最高下调1.5个百分点</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】那些年看的剧里十大虐心情节，谁戳中了你的泪点？</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】惨遭魔改？派拉蒙将拍真人版《你的名字。》</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】外媒称中国限制日本跟团游?旅行社:仍正常发团</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】广电总局：电台电视台应在重要法定节日播放国歌</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】高校性教育课成"爆款" 老师都讲哪些"大尺度"内容?</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】vivo X20全面屏手机首销火爆 陈赫欧豪现身助力</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】“拒绝妻子手术”现场医生：病人丈夫被冤枉了</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】游客们注意了！国庆你要避开十大坑</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】他卖了1.5万双假货，现在面临10年牢狱！</a>
								<a class="swiper-slide ep" href="udai_notice.html">【新闻】10月1日起国家再次提高部分优抚对象抚恤补助标准 烈属抚恤每年23130元</a>
							</div>
						</div>
					</div>
					<div class="buts-box bgf5">
						<div class="but-div">
							<a href="">
								<i class="but-icon"></i>
								<p>物流查询</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
								<i class="but-icon"></i>
								<p>热卖专区</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
								<i class="but-icon"></i>
								<p>满减专区</p>
							</a>
						</div>
						<div class="but-div">
							<a href="item_sale_page.html">
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
					<img src="/home/images/floor_2.jpg" alt="" class="cover">
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
					<img src="/home/images/floor_3.jpg" alt="" class="cover">
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
					<img src="/home/images/floor_4.jpg" alt="" class="cover">
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
				<a href="" class="r-item-hd">
					<i class="iconfont icon-liaotian"></i>
					<div class="r-tip__box"><span class="r-tip-text">联系客服</span></div>
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
@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
	@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
		<!-- 引入侧边栏 -->
			@include('home.layouts.sidebar')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">订单中心-我的收藏</div>
					<div class="collection-list__area clearfix">
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/M-001.jpg" alt="锦瑟 原创传统日常汉服男绣花交领衣裳cp情侣装春夏款" class="cover">
								<div class="name">锦瑟 原创传统日常汉服男绣花交领衣裳cp情侣装春夏款</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/M-002.jpg" alt="霜天月明 原创日常汉服男云纹绣花单大氅传统礼服外套" class="cover">
								<div class="name">霜天月明 原创日常汉服男云纹绣花单大氅传统礼服外套</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/M-003.jpg" alt="陇上乐原创传统日常汉服男绣花交领cp情侣非古装春秋" class="cover">
								<div class="name">陇上乐原创传统日常汉服男绣花交领cp情侣非古装春秋</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/M-004.jpg" alt="霜天月明 原创传统日常汉服男绣花交领衣裳cp春装单品" class="cover">
								<div class="name">霜天月明 原创传统日常汉服男绣花交领衣裳cp春装单品</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/M-005.jpg" alt="琅轩日常汉服男龙纹绣花短褙子气质传统外套春秋非古装" class="cover">
								<div class="name">琅轩日常汉服男龙纹绣花短褙子气质传统外套春秋非古装</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>

						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/S-001.jpg" alt="锦瑟 原创传统日常汉服男绣花交领衣裳cp情侣装春夏款" class="cover">
								<div class="name">锦瑟 原创传统日常汉服男绣花交领衣裳cp情侣装春夏款</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/S-002.jpg" alt="霜天月明 原创日常汉服男云纹绣花单大氅传统礼服外套" class="cover">
								<div class="name">霜天月明 原创日常汉服男云纹绣花单大氅传统礼服外套</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/S-003.jpg" alt="陇上乐原创传统日常汉服男绣花交领cp情侣非古装春秋" class="cover">
								<div class="name">陇上乐原创传统日常汉服男绣花交领cp情侣非古装春秋</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/S-004.jpg" alt="霜天月明 原创传统日常汉服男绣花交领衣裳cp春装单品" class="cover">
								<div class="name">霜天月明 原创传统日常汉服男绣花交领衣裳cp春装单品</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/S-005.jpg" alt="琅轩日常汉服男龙纹绣花短褙子气质传统外套春秋非古装" class="cover">
								<div class="name">琅轩日常汉服男龙纹绣花短褙子气质传统外套春秋非古装</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/M-006.jpg" alt="琅轩日常汉服男龙纹绣花短褙子气质传统外套春秋非古装" class="cover">
								<div class="name">琅轩日常汉服男龙纹绣花短褙子气质传统外套春秋非古装</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="/home/images/temp/S-006.jpg" alt="陇上乐原创传统日常汉服男绣花交领cp情侣非古装春秋" class="cover">
								<div class="name">陇上乐原创传统日常汉服男绣花交领cp情侣非古装春秋</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>18.0</div>
								<div class="sale"><a href="">取消收藏</a></div>
							</div>
						</div>
					</div>
					<div class="page text-right clearfix">
						<a class="disabled">上一页</a>
						<a class="select">1</a>
						<a href="">2</a>
						<a href="">3</a>
						<a class="" href="">下一页</a>
						<a class="disabled">1/3页</a>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
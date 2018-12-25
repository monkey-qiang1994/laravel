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
					@foreach($data as $k=>$v)
						<div class="item-card">
							<a href="item_show.html" class="photo">
								<img src="{{$v->product_img}}" alt="锦瑟 原创传统日常汉服男绣花交领衣裳cp情侣装春夏款" class="cover">
								<div class="name">{{$v->product_name}}</div>
							</a>
							<div class="middle">
								<div class="price"><small>￥</small>{{$v->price}}</div>
								<div class="sale"><a href="/user/collection/{{$v->product_id}}">取消收藏</a></div>
							</div>
						</div>
					@endforeach	
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
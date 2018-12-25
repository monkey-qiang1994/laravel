	<!-- 继承模版 -->
	@extends('home.layouts.public')

	<title>@yield('title','网站资讯')</title>

	@section('main')
	<div class="content inner">
		<section class="panel__div panel-message__div clearfix">
			<div class="filter-value">
				<div class="filter-title">平台公告</div>
			</div>
			<div class="pull-left">
				<div class="msg-list">
					@foreach($article as $list)
					<a class="swiper-slide ep" name="{{$list->article_id}}" href="/notice?id={{$list->article_id}}">【@if($list->article_type == 1) 新闻 @else 公告 @endif】{{$list->article_title}}</a>
					@endforeach
				</div>

				<div class="page">
					{{$article->appends($request)->render()}}
				</div>

			</div>
			<div class="message-box pull-right">
				<div class="head-div clearfix posr">
					<div class="title">【@if($select->article_type == 1) 新闻 @else 公告 @endif】{{$select->article_title}}</div>
					<div class="time pull-right">发布时间：{{$select->created_at}}</div>
				</div>
				<div class="html-code">
					{!! $select->article_content !!}
				</div>
			</div>
		</section>
	</div>
	<!-- 右侧菜单 -->
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

	<script>
		$('.swiper-slide').click(function(){
			$('.swiper-slide').removeClass("active");
			$(this).addClass('active');
		});

		id = $.getUrlParam('id');
		$('.swiper-slide').each(function(){
			if($(this).attr('name') == id){
				$(this).addClass('active');
			}
		});
	</script>
	@endsection

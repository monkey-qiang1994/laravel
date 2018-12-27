@extends('home.layouts.public')
<title>@yield('title','商品列表')</title>
@section('main')

	<div class="content inner">
		<section class="filter-section clearfix">
			<ol class="breadcrumb">
				<li><a href="http://www.laravel.com/">首页</a></li>
				<li class="active">商品列表</li>
			</ol>

			<div class="sort-box bgf5">

				<a href="http://www.laravel.com/list"><div class="sort-text">显示全部产品</div></a>
				
				<div class="sort-total pull-right">共{{count($result)}}个商品</div>
			</div>
		</section>
		<section class="item-show__div clearfix">
			<div class="pull-left">
				<div class="item-list__area clearfix">
				@if(!$result->isEmpty())
					@foreach($result as $row)
					<div class="item-card">
						<a href="/details/{{$row->product_id}}" class="photo">
							<img src="{{$row->product_img}}" class="cover">
							<div class="name">{{$row->product_name}}</div>
						</a>
						<div class="middle">

							<div class="price">
							<small>￥</small>
							@if($row->discount_price)
								{{$row->discount_price}}
								<s class="fz16 c9">{{$row->price}}</s>
							@else
								{{$row->price}}
								@endif
							</div>

							<div class="sale">{{$row->brand_name}}</div>
						</div>
						<div class="buttom">
							<?php $k=0;?>
							@foreach($sales as $sale)
								@if($row->product_id == $sale->product_id)
									<?php $k++;?>
								@endif
							@endforeach
							<div>销量 <b>{{$k}}</b></div>

							<?php $j=0;?>
							@foreach($collection as $colle)
								@if($row->product_id == $colle->product_id)
									<?php $j++;?>
								@endif
							@endforeach
							<div>人气 <b>{{$j}}</b></div>

							<?php $i=0;?>
							@foreach($evaluation as $eval)
								@if($row->product_id == $eval->product_id)
									<?php $i++;?>
								@endif
							@endforeach
							<div>评论 <b>{{$i}}</b></div>
						</div>
					</div>
					@endforeach
				@else
				<h1 style="text-align: center;color: #9d9d9d;font-weight: 100;">抱歉,没有您要的内容!</h1>
				@endif
				</div>
				<!-- 分页 -->
				<div class="page">
					{{$result->appends($request)->render()}}
				</div>
			</div>
			<div class="pull-right">
				
				<div class="desc-segments__content">
					<div class="lace-title">
						<span class="c6">爆款推荐</span>
					</div>
					<div class="picked-box">
						@foreach($recommend as $list)
						<a href="details/{{$list->product_id}}" class="picked-item">
							<img src="{{$list->product_img}}" alt="" class="cover">
							<span class="look_price">
								&yen; @if($list->discount_price)
								{{$list->discount_price}} <s class="fz16 c9">{{$list->price}}</s>
								@else
								{{$list->price}}
								@endif
							</span>
						</a>
						@endforeach
					</div>
				</div>
			</div>
		</section>
	</div>
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
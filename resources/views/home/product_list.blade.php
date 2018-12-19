@extends('home.layouts.public')
<title>@yield('title','商品列表')</title>
@section('main')
	<div class="content inner">
		<section class="filter-section clearfix">
			<ol class="breadcrumb">
				<li><a href="index.html">首页</a></li>
				<li class="active">商品列表</li>
			</ol>
			<div class="filter-box">
				<div class="all-filter">
					<div class="filter-value">
						<div class="filter-title">选择商品分类 <i class="iconfont icon-down"></i></div>
						<!-- 全部大分类 -->
						<ul class="catelist-card">
							<a href="/list"><li class="active">全部分类</li></a>
							@foreach($category as $cate_list)
							<a href="javascript:;" onclick="cate_id({{$cate_list->cate_id}})"><li>{{$cate_list->cate_name}}</li></a>
							@endforeach
						</ul>

					</div>
				</div>
				<div class="filter-prop-item">
					<span class="filter-prop-title">颜色：</span>
					<ul class="clearfix">
						<a href=""><li class="active">全部</li></a>
						@foreach($color as $col)
						<a href="javascript:;" onclick="color({{$col->att_id}})"><li>{{$col->att_name}}</li></a>
						@endforeach
					</ul>
				</div>
				<div class="filter-prop-item">
					<span class="filter-prop-title">尺寸：</span>
					<ul class="clearfix">
						<a href=""><li class="active">全部</li></a>
						@foreach($size as $si)
						<a href="javascript:;" onclick="size({{$si->att_id}})"><li>{{$si->att_name}}</li></a>
						@endforeach
					</ul>
				</div>
				<div class="filter-prop-item">
					<span class="filter-prop-title">价格：</span>
					<ul class="clearfix">
						<a href=""><li class="active">全部</li></a>
						<a href="javascript:;" onclick="price(0-50)"><li>0-50</li></a>
						<a href="javascript:;" onclick="price(50-100)"><li>50-100</li></a>
						<a href="javascript:;" onclick="price(100-150)"><li>100-150</li></a>
						<a href="javascript:;" onclick="price(150-100)"><li>150-200</li></a>
						<a href="javascript:;" onclick="price(0-50)"><li>250-300</li></a>
						<a href="javascript:;" onclick="price(300)"><li>300以上</li></a>
					</ul>
				</div>
			</div>

			<div class="sort-box bgf5">
				<div class="sort-text">排序：</div>
				<a href=""><div class="sort-text">销量 <i class="iconfont icon-sortDown"></i></div></a>
				<a href=""><div class="sort-text">评价 <i class="iconfont icon-sortUp"></i></div></a>
				<a href=""><div class="sort-text">价格 <i class="iconfont"></i></div></a>
				<div class="sort-total pull-right">共{{count($total)}}个商品</div>
			</div>
		</section>
		<section class="item-show__div clearfix">
			<div class="pull-left">
				<div class="item-list__area clearfix">
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
							<div>销量 <b>666</b></div>
							<div>人气 <b>888</b></div>
							<div>评论 <b>1688</b></div>
						</div>
					</div>
					@endforeach
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
						<a href="" class="picked-item"><img src="/home/images/temp/S-001.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/home/images/temp/S-002.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/home/images/temp/S-003.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/home/images/temp/S-004.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/home/images/temp/S-005.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/home/images/temp/S-006.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/home/images/temp/S-007.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						<a href="" class="picked-item"><img src="/home/images/temp/S-008.jpg" alt="" class="cover"><span class="look_price">¥134.99</span></a>
						
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- 右侧菜单 -->
	<div class="right-nav">
		<ul class="r-with-gotop">
			<li class="r-toolbar-item">
				<a href="udai_welcome.html" class="r-item-hd">
					<i class="iconfont icon-user" data-badge="0"></i>
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
				<a href="udai_collection.html" class="r-item-hd">
					<i class="iconfont icon-aixin"></i>
					<div class="r-tip__box"><span class="r-tip-text">我的收藏</span></div>
				</a>
			</li>
			<li class="r-toolbar-item">
				<a href="issues.html" class="r-item-hd">
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
		//获取点击的分类id
		function cate_id(id){
			
		}

		//获取点击的颜色属性id
		function color(id){
			
		}

		//获取点击的尺寸属性id
		function size(id){
			
		}

		//获取点击的价格
		function price(from,to){

		}
		

	</script>
@endsection
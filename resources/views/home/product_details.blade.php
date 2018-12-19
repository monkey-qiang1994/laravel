@extends('home.layouts.public')
<title>@yield('title',"商品内页")</title>
@section('main')

	<style>
		input[type="radio"]{
			display: none;
		}

		.savetips{
			width: 220px;
			height: 50px;
			border-radius: 20px;
			background: #454545;
			font-size: 16px;
			font-family: 'Montserrat', sans-serif;
			font-weight: bold;
			text-align: center;
			line-height: 50px;
        	position: fixed;
        	top:50%;
        	left: calc(50% - 110px);
        	color: #fff;}
	</style>
	<div class="content inner">
		<section class="item-show__div item-show__head clearfix">
			<div class="pull-left">
<!-- 				<ol class="breadcrumb">
					<li><a href="index.html">首页</a></li>
					<li><a href="item_sale_page.html">爆款推荐</a></li>
					<li class="active">原创设计日常汉服女款绣花长褙子吊带改良宋裤春夏</li>
				</ol> -->
				<div class="item-pic__box" id="magnifier">
					<div class="small-box">
						<img class="cover" src="{{$images[0]->product_img}}" alt="{{$product->product_name}}">
						<span class="hover"></span>
					</div>
					<div class="thumbnail-box">
						<a href="javascript:;" class="btn btn-default btn-prev"></a>
						<div class="thumb-list">
							<ul class="wrapper clearfix">
								@foreach($images as $image)
								<li class="item"><img class="cover" src="{{$image->product_img}}" alt="{{$product->product_name}}"></li>
								@endforeach
							</ul>
						</div>
						<a href="javascript:;" class="btn btn-default btn-next"></a>
					</div>

					<!-- 放大镜效果出现的大图 -->
					<div class="big-box">
						<img class="big" src="{{$images[0]->product_img}}">
					</div>
					<!-- 放大镜效果结束 -->
					<!-- 产品图片特效 -->
					<script>
						//鼠标移入小图的时候大图跟着切换
						$('.thumb-list').find('li').each(function(){
							$(this).mouseover(function(){
								
								//获取当前鼠标移入图片的路径
								src = $(this).find('.cover').attr("src");
								//把获取到的路径插入到大图中
								$('.small-box').find('.cover').attr('src',src);
								//先把默认把所有li的active去掉
								$('.wrapper').find('li').removeClass('active')
								//给当前鼠标移入的图片加上active
								$(this).addClass('active');
								
							});
						});

						//鼠标移入大图的时候获取当前大图的路径,然后写入放大镜效果的图片中
						$('.small-box').find('.cover').mouseover(function(){
							src = $(this).attr('src');

							$('.big-box').find('.big').attr('src',src);
						});
						


					</script>
					<!-- 产品图片特效结束 -->
				</div>
				<script src="/home/js/jquery.magnifier.js"></script>
				<script>
					$(function () {
						$('#magnifier').magnifier();
					});
				</script>
				<div class="item-info__box">
					<div class="item-title">
						<div class="name ep2">{{$product->product_name}}</div>
						<div class="sale cr">优惠活动：该商品享受8折优惠</div>
					</div>
					<div class="item-price bgf5">
						<div class="price-box clearfix">
							<div class="price-panel pull-left">
								@if($product->discount_price != '')
								售价：<span class="price">￥ {{$product->discount_price}} <s class="fz16 c9">￥ {{$product->price}}</s></span>
								@else
								售价：<span class="price">￥ {{$product->price}}</span>
								@endif
							</div>

							<!-- <div class="vip-price-panel pull-right">
								会员等级价格 <i class="iconfont icon-down"></i>
								<ul class="all-price__box">
									<!-- 登陆后可见 
									<li><span class="text-justify">普通：</span>40.00元</li>
									<li><span class="text-justify">银牌：</span>38.00元</li>
									<li><span class="text-justify">超级：</span>28.00元</li>
									<li><span class="text-justify">V I P：</span>19.20元</li>
								</ul>
							</div> -->

						</div>
					</div>
					<ul class="item-ind-panel clearfix">
						<li class="item-ind-item">
							<span class="ind-label c9">累计销量</span>
							<span class="ind-count cr">1688</span>
						</li>
						<li class="item-ind-item">
							<a href=""><span class="ind-label c9">累计评论</span>
							<span class="ind-count cr">1314</span></a>
						</li>
					</ul>
					<div class="item-key">

						<!-- 产品属性开始 -->
						<div class="item-sku">
							@foreach($cate_att as $cate_name)
							<dl class="item-prop clearfix">
								<dt class="item-metatit">{{$cate_name->cate_att_name}}：</dt>
								<dd>
									<ul data-property="{{$cate_name->cate_att_name}}" class="clearfix attributes">
									@foreach($att_list as $att)
										@if($att->cate_att_id == $cate_name->cate_att_id)
										<li>
											<a href="javascript:;" role="button" data-value="{{$att->att_name}}" aria-disabled="true">
												<input type="radio" value="{{$att->att_name}}" name="{{$cate_name->cate_att_name}}" id="{{$att->att_id}}">
												<label for="{{$att->att_id}}" style="font-weight:100;cursor:pointer;">{{$att->att_name}}</label>
											</a>
										</li>
										@endif
									@endforeach
									</ul>
								</dd>
							</dl>
							@endforeach
						</div>
						<!-- 产品属性结束 -->
						<!-- 设置隐藏域放产品id -->
						<input type="hidden" class="product_id" value="{{$product->product_id}}">
						<div class="item-amount clearfix bgf5">
							<div class="item-metatit">数量：</div>
							<div class="amount-box">
								<div class="amount-widget">
									<input class="amount-input" value="1" maxlength="8" title="请输入购买量" type="text" style="border: 1px solid #ccc;">
									<div class="amount-btn">
										<a class="amount-but add"></a>
										<a class="amount-but sub"></a>
									</div>
								</div>
								<div class="item-stock"><span style="margin-left: 10px;">库存 <b id="stock">{{$product->stock}}</b> 件</span></div>
								<script>
									
									//库存数量
									stock = $('#stock').html();

										$('.amount-btn').find('.add').click(function(){
											//获取input里的数量值
								    		num = $('.amount-input').val();

											num++;
											if(num<=stock){
												$('.amount-input').val(num);
											}else{
												alert('数量无法超过库存量!');
											}
										});

										$('.amount-btn').find('.sub').click(function(){
											//获取input里的数量值
								    		num = $('.amount-input').val();

											num--;
											if(num>0){
												$('.amount-input').val(num);
											}else{
												alert('数量不能小于1!');
											}
										});

								</script>
							</div>
						</div>
						<div class="item-action clearfix bgf5">
							<a href="javascript:;" onclick="addCart()" rel="nofollow" data-addfastbuy="true" role="button" class="item-action__basket">
								<i class="iconfont icon-shopcart"></i> 加入购物车
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="pull-right picked-div">

			<!-- 侧边栏推荐商品开始 -->
				<div class="lace-title">
					<span class="c6">爆款推荐</span>
				</div>
				<div class="swiper-container picked-swiper">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							@foreach($recommend as $list)
							<a class="picked-item" href="">
								<img src="{{$list->product_img}}" alt="" class="cover">
								<div class="look_price">¥ {{$list->price}}</div>
							</a>
							@endforeach
						</div>
					</div>
				</div>
				<!-- 侧边栏推荐商品结束 -->
				<script>
					$(document).ready(function(){
						var recommends = new Swiper('.recommends-swiper', {
							spaceBetween : 40,
							autoplay : 5000,
						});
					});
				</script>
				<div class="picked-button-prev"></div>
				<div class="picked-button-next"></div>
				<script>
					$(document).ready(function(){ 
						// 顶部banner轮播
						var picked_swiper = new Swiper('.picked-swiper', {
							loop : true,
							direction: 'vertical',
							prevButton:'.picked-button-prev',
							nextButton:'.picked-button-next',
						});
					});
				</script>
			</div>
		</section>
		<section class="item-show__div item-show__body posr clearfix">
			<div class="item-nav-tabs">
				<ul class="nav-tabs nav-pills clearfix" role="tablist" id="item-tabs">
					<li role="presentation" class="active"><a href="#detail" role="tab" data-toggle="tab" aria-controls="detail" aria-expanded="true">商品详情</a></li>
					<li role="presentation"><a href="#evaluate" role="tab" data-toggle="tab" aria-controls="evaluate">累计评价 <span class="badge">1314</span></a></li>
					<li role="presentation"><a href="#service" role="tab" data-toggle="tab" aria-controls="service">售后服务</a></li>
				</ul>
			</div>
			<div class="pull-left">
				<div class="tab-content">
					<!-- 商品详情 -->
					<div role="tabpanel" class="tab-pane fade in active" id="detail" aria-labelledby="detail-tab" style="text-align: center;">
						{!! $product->description !!}
						
					</div>

					<!-- 商品评论 -->
					<div role="tabpanel" class="tab-pane fade" id="evaluate" aria-labelledby="evaluate-tab">
						<div class="evaluate-tabs bgf5">
							<ul class="nav-tabs nav-pills clearfix" role="tablist">
								<li role="presentation" class="active"><a href="#all" role="tab" data-toggle="tab" aria-controls="all" aria-expanded="true">全部评价 <span class="badge">1314</span></a></li>
								<li role="presentation"><a href="#good" role="tab" data-toggle="tab" aria-controls="good">好评 <span class="badge">1000</span></a></li>
								<li role="presentation"><a href="#normal" role="tab" data-toggle="tab" aria-controls="normal">中评 <span class="badge">314</span></a></li>
								<li role="presentation"><a href="#bad" role="tab" data-toggle="tab" aria-controls="bad">差评 <span class="badge">0</span></a></li>
							</ul>
						</div>
						<div class="evaluate-content">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="all" aria-labelledby="all-tab">

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a href="">6</a>
										<a href="">7</a>
										<a href="">8</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/60页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="good" aria-labelledby="good-tab">
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a href="">6</a>
										<a href="">7</a>
										<a href="">8</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/20页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="normal" aria-labelledby="normal-tab">
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>


									<!-- 分页 -->
									<div class="page text-center clearfix">
										<a class="disabled">上一页</a>
										<a class="select">1</a>
										<a href="">2</a>
										<a href="">3</a>
										<a href="">4</a>
										<a href="">5</a>
										<a class="" href="">下一页</a>
										<a class="disabled">1/5页</a>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="bad" aria-labelledby="bad-tab">

									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									
									<div class="eval-box">
										<div class="eval-author">
											<div class="port">
												<img src="/home/images/icons/default_avt.png" alt="欢迎来到U袋网" class="cover b-r50">
											</div>
											<div class="name">高***恒</div>
										</div>
										<div class="eval-content">
											<div class="eval-text">
												真是特别美_回头穿了晒图
											</div>
											<div class="eval-imgs">
												<div class="img-temp"><img src="/home/images/temp/S-001-1_s.jpg" data-src="/home/images/temp/S-001-1_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-2_s.jpg" data-src="/home/images/temp/S-001-2_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-3_s.jpg" data-src="/home/images/temp/S-001-3_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-4_s.jpg" data-src="/home/images/temp/S-001-4_b.jpg" data-action="zoom" class="cover"></div>
												<div class="img-temp"><img src="/home/images/temp/S-001-5_s.jpg" data-src="/home/images/temp/S-001-5_b.jpg" data-action="zoom" class="cover"></div>
											</div>
											<div class="eval-time">
												2017年08月11日 20:31 颜色分类：深棕色 尺码：均码
											</div>
										</div>
									</div>
									<!-- 分页 -->
									<div class="page text-center clearfix">
									</div>
								</div>
							</div>
							<script src="/home/js/jquery.zoom.js"></script>
						</div>
					</div>

					<!-- 售后服务 -->
					<div role="tabpanel" class="tab-pane fade" id="service" aria-labelledby="service-tab">
						<!-- 富文本 -->
						<div class="service-content rich-text">
							<img title="" alt="" src="http://img.aocmonitor.com.cn/image/2014-06/86575417.gif" width="240" height="160" border="0" align="left"><p>承蒙惠购 AOC 产品，谨致谢意！为了让您更好地使用本产品，武汉艾德蒙科技股份有限公司通过该产品随机附带的保修证向您做出下述维修服务承诺，并按照该服务的承诺向您提供维修服务。</p><p>这些服务承诺仅适用于2016年6月1日（含）之后销售的AOC品牌显示器标准品。</p><p>如果您选择购买了 AOC 显示器扩展功能模块或其它厂家电脑主机，其保修承诺请参见相应产品的保修卡。</p><p>所有承诺内容以产品附件的保修卡为准。</p><p><br></p><h3>一、全国联保</h3><p style="text-indent:2em">AOC 显示器实施全国范围联保，国家标准三包服务。无论您是在中国大陆 ( 不含香港、澳门、台湾地区) 何处购买并在大陆地区使用的显示器，出现三包范围内的故障时，可凭显示器的保修证正本和购机发票到 AOC 显示器维修网点或授权网点进行维修同时，也欢迎您关注官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)进行查询。</p><div style="text-align:center"><img src="http://img.aocmonitor.com.cn/image/2017-05/89154415.jpg" alt=""></div><p><br></p><p>三包服务如下：</p><ol><li>商品自售出之日起 7 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择退货、换货或修理。</li><li>商品自售出之日起 15 日内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择换货或修理。</li><li>商品自售出之日起 1 年内，出现《微型计算机商品性能故障表》中所列故障时，消费者可选择修理。</li></ol><p>以下情况不在三包范围内：</p><ol><li>超过三包有效期。</li><li>无有效的三包凭证及发票。</li><li>发票上内容与商品实物标识不符或者涂改的。</li><li>未按产品使用说明书要求使用、维护、保养而造成损坏的（人为损坏）。</li><li>非 AOC 授权的修理者拆动造成损坏的（私自拆修）。</li><li>非 AOC 在中国大陆（不含香港、澳门、台湾地区）销售的商品。</li></ol><h3>二、显示器专享服务</h3><p><strong>1、LUVIA视界头等舱，VIP专享服务</strong></p><p style="text-indent:2em">AOC针对各省市地区采取指定商品销售，消费者购买指定销往该区域的LUVIA卢瓦尔显示器标准品，从发票开具之日起1年内，注册成为官方微信服务号“AOC用户俱乐部”(微信号：aocdisplay)产品会员，即可在当地享“LUVIA视界头等舱，VIP专享服务”。</p><div style="text-align:center"><img src="http://img.aocmonitor.com.cn/image/2017-05/25352146.jpg" alt=""></div><p><br></p><p style="text-indent:2em">* 如客户未在发票开具之日起1年内注册AOC微信会员，则只享受国家三包服务。</p><p style="text-indent:2em">注册会员方式：1、关注“AOC用户俱乐部”微信公众号。2、点击“会员”→“注册会员”。3、填写个人真实信息并注册产品信息，即可成为AOC产品会员。</p><p style="text-indent:2em"><strong>3年免费上门更换</strong>：从发票开具之日起3年内，产品若发生《微型计算机商品性能故障表》所列性能故障，可免费更换不低于同型号同规格产品。（服务网点无法覆盖区域，全国区域免费邮寄，双向运费由AOC负担）</p><p style="text-indent:2em"><strong>一键快捷掌上服务：</strong>从注册成为“AOC用户俱乐部”会员之日起，可享在线贴身技术顾问有问必答、售后服务在线预约、服务网点在线查询等一键快捷掌上服务。（人工客服咨询在线时间：8:00-22:00）</p><p style="text-indent:2em"><strong>增值豪礼尊享服务：</strong>可参加“AOC用户俱乐部”有奖互动赢取豪礼。</p><p>注：<br>(1)如不能及时提供购机发票或发票记载不清、涂改、商品实物标示和发票内容不符，将以您上传“AOC用户俱乐部”的发票信息为准计算保修时间；如果发票信息并未上传，将以该显示器制造日期(制造日期见显示器后壳条形码标签)加一个月为准计算保修时间。<br>(2)非“AOC用户俱乐部”产品会员，不享受“LUVIA视界头等舱，VIP专享服务”。</p>
						</div>
					</div>
			    </div>
				
			</div>
			<div class="pull-right">
				<div class="tab-content" id="descCate">
					<div role="tabpanel" class="tab-pane fade in active" id="detail-tab" aria-labelledby="detail-tab">
						<div class="descCate-content bgf5">
							<dd class="dc-idsItem selected">
								<a href="#desc-module-1"><i class="iconfont icon-dot"></i> 产品图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-2"><i class="iconfont icon-selected"></i> 细节图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-3"><i class="iconfont"></i> 尺寸及试穿</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-4"><i class="iconfont"></i> 模特效果图</a>
							</dd>
							<dd class="dc-idsItem">
								<a href="#desc-module-5"><i class="iconfont"></i> 常见问题</a>
							</dd>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="evaluate-tab" aria-labelledby="evaluate-tab">
						<div class="descCate-content posr bgf5">
							<div class="lace-title">
								<span class="c6">相关推荐</span>
							</div>
							<div class="picked-box">
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-1_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-2_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-3_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-4_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-5_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade" id="service-tab" aria-labelledby="service-tab">
						<div class="descCate-content posr bgf5">
							<div class="lace-title">
								<span class="c6">最近浏览</span>
							</div>
							<div class="picked-box">
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-1_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-2_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-3_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-4_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
								<a class="picked-item" href="">
									<img src="/home/images/temp/S-001-5_s.jpg" class="cover">
									<div class="look_price">¥134.99</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$(document).ready(function(){
					$('#descCate').smartFloat(0);
					$('.dc-idsItem').click(function() {
						$(this).addClass('selected').siblings().removeClass('selected');
					});
					$('#item-tabs a[data-toggle="tab"]').on('show.bs.tab', function (e) {
						$('#descCate #' + $(e.target).attr('aria-controls') + '-tab')
						.addClass('in').addClass('active').siblings()
						.removeClass('in').removeClass('active');
					});
				});
			</script>
		</section>
		<div id="addBox" class="savetips" style="display:none;">已加入购物车!</div>
	</div>
	<script>
	//产品属性
	//颜色栏设置先默认选中第一个属性
	$('.item-prop').eq(0).find('input').eq(0).attr('checked',true);
	$('.item-prop').eq(0).find('a').eq(0).addClass('on');
	//先把默认选中的值给color变量
	var color = $('.item-prop').eq(0).find('input').eq(0).val();

	$('.item-prop').eq(0).find('a').click(function(){
		//先默认去掉其他元素的checked
		$('.item-prop').eq(0).find('input').attr('checked',false);
		//循环颜色栏的所有input内容
		$(this).find('input').each(function(){
			//给点击的元素增加checked选中属性
			$(this).attr('checked',true);
			//先把所有a链接的class="on"去掉
			$('.item-prop').eq(0).find('a').removeClass('on');
			//然后给点击的按纽加上class="on"类
			$(this).parents('a').addClass('on');

			//把当前选中的颜色属性赋值给color变量
			color = $(this).val();
		});
	});

	//尺码栏设置先默认选中第一个属性
	$('.item-prop').eq(1).find('input').eq(0).attr('checked',true);
	$('.item-prop').eq(1).find('a').eq(0).addClass('on');
	//先把默认选中的值给size变量
	var size = $('.item-prop').eq(1).find('input').eq(0).val();

	$('.item-prop').eq(1).find('a').click(function(){
		//先默认去掉其他元素的checked
		$('.item-prop').eq(1).find('input').attr('checked',false);
		//循环尺码栏的所有input内容
		$(this).find('input').each(function(){
			//给点击的元素增加checked选中属性
			$(this).attr('checked',true);
			//先把所有a链接的class="on"去掉
			$('.item-prop').eq(1).find('a').removeClass('on');
			//然后给点击的按纽加上class="on"类
			$(this).parents('a').addClass('on');

			//把当前选中的尺码属性赋值给size变量
			size = $(this).val();
		});
	});

	//ajax将产品添加到数据库中
	//用户ID
	user = "<?php echo Session::get('user_id',false)?>";
	num = $('.amount-input').val();
	id = $('.product_id').val();
	
	data = new Array();
	

	function addCart(){
		data.push(user);
		data.push(id);
		data.push(num);
		data.push(color);
		data.push(size);
		random=Math.random();

		$.get('/addCart?random='+random,{data:data},function(res){

			if(res==1){
				$('#addBox').show().delay(1500).fadeOut();
				location.reload();
			}else if(res==3){
				alert('您还未登录,请先登录!');
				window.location.href='http://www.laravel.com/login/create';
			}

		});
	}
	
	
	</script>
@endsection
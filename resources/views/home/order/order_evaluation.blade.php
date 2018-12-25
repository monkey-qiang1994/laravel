@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
@section('main')
<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
		<!-- 引入侧边栏 -->
			@include('home.layouts.sidebar')			
				<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">订单中心-商品评价</div>
					@foreach($detail as $detail_v)
					<div class="evaluate_box">
						<div class="evaluate_info posr clearfix">
							<div class="img"><img src="{{$detail_v->product_img}}" alt="" class="cover"></div>
							<div class="name ep2">{{$detail_v->product_name}}</div>
							<div class="param">
								<div class="param-row"><span class="param-label">单价</span><b class="cr fz24">{{$detail_v->product_price}}</b><span class="cr">元</span></div>
								<div class="param-row"><span class="param-label">数量</span><span class="c6 fz20">{{$detail_v->product_num}}</span></div>
								<div class="param-row"><span class="param-label">小计</span><span class="c6 fz20">{{$detail_v->product_price*$detail_v->product_num}}元</span></div>
								
							</div>
							<div class="info c6">
								{{$detail_v->product_attr}}<br>
								现在查看的是您所购商品的信息 于{{Date('Y-m-d H:i:s',$detail_v->created_at)}}下单购买了此商品
							</div>
						</div>
					</div>
					@endforeach
					<p class="fz18 cr">商品评价</p>
					<div class="modify_div">
						<form action="/user/process_evaluation" method="post" class="evaluate-form__box" enctype="multipart/form-data">
							{{csrf_field()}}
							@foreach($evaluation as $evaluation_v)
							<input type="hidden" name="product_id[]" value="{{$evaluation_v->product_id}}">
							<input type="hidden" name="order_id" value="{{$evaluation_v->order_id}}">
							<span class="help-block">商品名称:{{$evaluation_v->product_name}}</span>
							<table class="table table-bordered">
								<tbody><tr>
									<th scope="row">评价等级</th>
									<td class="user-form-group fz0">
										<label><input name="grade{{$evaluation_v->product_id}}" value="0" checked="" type="radio"><i class="iconfont icon-radio"></i> <span>好评</span></label>
										<label><input name="grade{{$evaluation_v->product_id}}" value="1" type="radio"><i class="iconfont icon-radio"></i> <span>中评</span></label>
										<label><input name="grade{{$evaluation_v->product_id}}" value="2" type="radio"><i class="iconfont icon-radio"></i> <span>差评</span></label>
									</td>
								</tr>
								<tr>
									<th scope="row">评价商品</th>
									<td><textarea name="content{{$evaluation_v->product_id}}" rows="5" placeholder="请输入您对该商品的评价~"></textarea></td>
								</tr>
								<tr valign="middle">
									<th scope="row">晒图片</th>
									<td>
										<input type="file" name="pic{{$evaluation_v->product_id}}" multiple="multiple"">
									</td>
								</tr>
							</tbody></table>
							@endforeach
							<div class="checkbox">
								<button type="submit" class="but pull-right">提交评价</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	@endsection
@extends('home.layouts.public')
<title>@yield('title','结算页面')</title>
@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<div class="user-content__box clearfix bgf">
				<div class="title">购物车-确认支付 </div>
				<div class="shop-title">收货地址</div>
				<form action="/user/order_cart" method="post" class="shopcart-form__box">
					{{csrf_field()}}
					<div class="addr-radio">
						<div class="radio-line radio-box active">
							<label class="radio-label ep" title="福建省 福州市 鼓楼区 温泉街道 五四路159号世界金龙大厦20层B北 福州rpg.blue网络 （喵喵喵 收） 153****9999">
								<input name="address_id" checked="" value="0" autocomplete="off" type="radio"><i class="iconfont icon-radio"></i>
								福建省 福州市 鼓楼区 温泉街道
								五四路159号世界金龙大厦20层B北 福州rpg.blue网络
								（喵喵喵 收） 153****9999
							</label>
							<a href="javascript:;" class="default">默认地址</a>
							<a href="udai_address_edit.html" class="edit">修改</a>
						</div>

					</div>
					<div class="add_addr"><a href="udai_address.html">添加新地址</a></div>
					<div class="shop-order__detail">
						<table class="table">
							<thead>
								<tr>
									<th width="120"></th>
									<th width="300">商品信息</th>
									<th width="150">单价</th>
									<th width="200">数量</th>
									<th width="80">总价</th>
								</tr>
							</thead>
							<tbody>
								@foreach($detail as $detail_v)
								<tr>
									<th scope="row">
										<a href="item_show.html">
											<div class="img">
												<img src="{{$detail_v->product_img}}" alt="" class="cover" style="height: 200px;width: 100px">
											</div>
										</a>
									</th>
									<td>
										<div class="name ep3">{{$detail_v->product_name}}</div>
										<div class="type c9">{{$detail_v->product_attr}}</div>
									</td>
									<td>¥{{$detail_v->product_price}}</td>
									<td>{{$detail_v->product_num}}</td>
									<td>¥{{$detail_v->product_num*$detail_v->product_price}}</td>
								</tr>

								@endforeach
							</tbody>
						</table>
					</div>
					<div class="shop-cart__info clearfix">
						@foreach($order as $order_v)
						<div class="pull-left text-left">
							<div class="info-line text-nowrap">订单创建时间：<span class="c6">{{Date('Y-m-d H:i:s',$order_v->created_at)}}</span></div>
							<div class="info-line text-nowrap">交易类型：<span class="c6">担保交易</span></div>
							<div class="info-line text-nowrap">交易号：<span class="c6">{{$order_v->order_num}}</span></div>
						</div>
						<input type="hidden" id="total"  name="total" value="{{$order_v->total}}">
						<input type="hidden"  name="order_id" value="{{$order_v->order_id}}">
						@endforeach
						<div class="pull-right text-right">
							<div class="form-group">
								<label for="coupon" class="control-label">优惠券使用：</label>
								<select id="coupon" name="coupon_id">
									<option value="-1" selected >- 不使用的优惠券 -</option>
									@foreach($coupon as $coupon_v)
									<option value="{{$coupon_v->coupon_id}}" class="coupon">【满￥{{$coupon_v->coupon_down}}元减￥{{$coupon_v->coupon_price}}】</option>
									@endforeach
								</select>
							</div>
							<div class="info-line">优惠活动：<span class="c6" id="coupon-action">【无】</span></div>
							<div class="info-line">总价：<span class="c6 " id="all-total">¥0.00</span></div>
							<div class="info-line">已优惠 <span class="favour-value" id="coupon-price">¥0.0</span>合计：<b class="fz18 cr" id="he-total">0.00</b></div>
						</div>
					</div>
					<div class="user-form-group shopcart-submit">
						<button type="submit" class="btn btn-submit" >去支付</button>
					</div>
				</form>
			</div>

					<!-- 选择优惠券时候改变 -->
					<script type="text/javascript">

						//总价
						var total = $('#total').val();
						//下
						var down = $('#coupon_down').val();
						//优惠券价格
						var price = $('#coupon_price').val();
						$('#all-total').html('￥'+total);
						$('#he-total').html('￥'+total);

						$(document).ready(function(){
							$(this).on('change','input',function() {
								$(this).parents('.radio-box').addClass('active').siblings().removeClass('active');
								$('.btn-submit').attr("disabled",false);

							})
						});
						$('#coupon').change(function(){
							//优惠券
							var coupon = $(this).val();
							// alert(coupon);
							$.get('/user/order_coupon',{coupon:coupon},function(data){
								if (data != 0) {
									res = JSON.parse(data);
									//优惠间下
									var coupon_down = res[0]['coupon_down'];
									//优惠券价格
									var coupon_price = res[0]['coupon_price'];
									if (coupon_down > total) {
										alert('不满足优惠券使用规则');
										$('#he-total').html('￥'+(parseInt(total)));
										$('#coupon-price').html('￥'+'0');
										$('#coupon-action').html('【无】');
										$('#pay_mode').val(222);

									}else{
										$('#he-total').html('￥'+(parseInt(total)-parseInt(coupon_price)));
										$('#coupon-price').html('￥'+parseInt(coupon_price));
										$('#coupon-action').html('【满￥'+coupon_down+'元减￥'+coupon_price+'】' );
										$('#pay_mode').val(222);

									}								
									
								}
							})

						})
					</script>
		</section>
	</div>
	@endsection
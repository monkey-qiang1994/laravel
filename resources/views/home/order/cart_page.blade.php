
@extends('home.layouts.public')

<title>@yield('title','购物车')</title>

@section('main')
<!-- 未勾选商品时出现的提示框开始 -->
	<style>
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

	<div id="cart_empty" class="savetips" style="display:none;">请至少选中一个商品再提交!</div>

 	@if(Session::has('error'))
	
	<script type="text/javascript">
		$('#cart_empty').show().delay(1500).fadeOut();
	</script>

    @endif
<!-- 提示框结束 -->
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<div class="user-content__box clearfix bgf">
				<div class="title">购物车</div>
				<form action="/user/order_pay" method="post"  class="shopcart-form__box">
					{{csrf_field()}}
					<table class="table table-bordered">
						<thead class="thead">
							@if($info != 'x')
							<tr>
								<th width="150">
									<label class="checked-label"><input type="checkbox" class="check-all " value="0"><i></i> 全选</label>
								</th>
								<th width="300">商品信息</th>
								<th width="150">单价</th>
								<th width="200">数量</th>
								<th width="200">总价</th>
								<th width="80">操作</th>
							</tr>
							@endif
						</thead>
						<tbody>

							@if($info != 'x')
							@foreach($res as $v)
							<tr>
								<th scope="row">
									<label class="checked-label">
										<input type="checkbox" class="input" value="{{$v->id}}" name="id[]"><i></i>
										<div class="img"><img src="{{$v->product_img}}" alt="" class="cover" style="height: 150px"></div>
									</label>
								</th>
								<td>
									<div class="name ep3">{{$v->product_name}}</div>
									<div class="type c9">{{$v->product_att}}</div>
								</td>
								<td>{{$v->price}}</td>
								<td>
									<div class="cart-num__box">
										<input type="button" class="sub" value="-">
										<input type="text" class="val" value="{{$v->product_num}}" maxlength="2" >
										<input type="button" class="add" value="+">
									</div>
								</td>
								<td id="price" >{{$v->product_num*$v->price}}</td>
								<td>
										<input type="hidden" name="product_id" value="{{$v->product_id}}">
										<a class="del" href="javascript:void(0)">删除</a>
								</td>
							</tr>
							@endforeach
							@else
							<div style="height: 200px;text-align: center;line-height: 200px;font-size: 25px;font-weight: bold;color: #b31e22;position: relative;top: 0px">购物车里是空的....
							<a href="/" style="color: #62c1fb">快去购物吧!!</a></div>
							@endif
						</tbody>
					</table>
					<div class="user-form-group tags-box shopcart-submit pull-right">
						<button type="submit" class="btn">提交订单</button>
					</div>
					<div class="checkbox shopcart-total">
				
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="" style="font-size: 16px;color: #666;font-weight: bold;"><<<清空购物车</a>
						<div class="pull-right">
							
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;合计（不含运费）
							<b class="cr">¥<span class="fz24 " id="total">0.00</span></b>
						</div>
					</div>
					<script>
						//全选
						function del(){
							console.log($(this));
						}

						$(document).ready(function(){
							var $item_checkboxs = $('.input[type="checkbox"]'),
								$check_all = $('.check-all');
							// 全选
							$check_all.click(function() {
								$item_checkboxs.prop('checked', $(this).prop('checked'));
								var total = 0
								var i = 0;
								$.each($('input:checkbox:checked'),function(){
									i++;
								if(i!=1){
									total += $(this).parents('tr').find('#price').html() * 1;
								}
				                   
				                    // alert(total);
				           		 });
								// alert(total)
				           		$('#total').html(total);
								
				           	//单个选
							
							});
						//ajax删除
						$('.del').click(function(){
							//获取要删除的id
							var product = $(this).prev().val();
							//删除
							$.get('/user/cart_del',{product:product},function(data){
								if (data ==1 ) {
									location.reload();
								}else{
									alert('删除失败')
								}
							})
						})




							// 个数限制输入数字
							$('input.val').onlyReg({reg: /[^0-9.]/g});
							// 加减个数
							$('.cart-num__box').on('click', '.sub,.add', function() {
								var value = parseInt($(this).siblings('.val').val());
								if ($(this).hasClass('add')) {
									$(this).siblings('.val').val(Math.min((value += 1),5));
									//数量
									var num = $(this).prev().val();
									// alert(num);
									//修改的id
									var id = $(this).parents('tr').find('.input').val();
									$.get('/user/ordernum_change',{num:num,id:id},function(data){
										if (data ==1) {
											location.reload();
										}
									},'json')
								} else {

									$(this).siblings('.val').val(Math.max((value -= 1),1));

									//数量
									var num = $(this).next().val();
									// alert(num);
									//修改的id
									var id = $(this).parents('tr').find('.input').val();
									$.get('/user/ordernum_change',{num:num,id:id},function(data){
								
									},'json')

								}
							});
						});

						  //提示信息
						  var success = $('.success').html();
						  function modaldemo(){
						  $("#modal-demo").modal("show")}
						      function modalalertdemo(){
						      $.Huimodalalert(success,1000)}
						  if (success) {
						    modalalertdemo();
						  }
						  //提示信息
						  var success = $('.error').html();
						  function modaldemo(){
						  $("#modal-demo").modal("show")}
						      function modalalertdemo(){
						      $.Huimodalalert(success,1000)}
						  if (success) {
						    modalalertdemo();
						  }

					</script>

				</form>
			</div>
		</section>
	</div>
	@endsection
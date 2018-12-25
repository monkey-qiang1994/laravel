@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<!-- 引入侧边栏 -->
			@include('home.layouts.sidebar')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">账户信息</div>
					@if(session('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>	
						{{session('success')}}</div>
					@elseif(session('error'))
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{session('error')}}</div>
					@endif
					
					<form action="/user/modifypwd/{{$data->user_id}}" method="post" class="user-setting__form" role="form">
						{{csrf_field()}}
						{{method_field('put')}}
						<div class="input-group user-form-group">
							<span class="input-group-addon" id="sizing-addon2">用户名</span>
							<label><input type="text" name="username" class="form-control"  value="{{$data->username}}" aria-describedby="sizing-addon2"></label>
						</div>
						<div class="input-group user-form-group">
							<span class="input-group-addon" id="sizing-addon2">手机号</span>
							<label><input type="text" name="phone" class="form-control zhuce"  value="{{$data->phone}}" aria-describedby="sizing-addon2"></label>	
						</div>
						<div class="input-group user-form-group">
							<span class="input-group-addon" id="sizing-addon2">密码</span>
							<label><input type="password" name="password" class="form-control"  value="{{$data->password}}" aria-describedby="sizing-addon2"></label>
						</div>
						<div class="input-group user-form-group">
							<span class="input-group-addon" id="sizing-addon2">邮箱</span>
							<label><input type="text" name="email" class="form-control"  value="{{$data->email}}" aria-describedby="sizing-addon2"></label>
						</div>
						<!-- <div class="input-group user-form-group">
							<span class="input-group-addon" id="sizing-addon2">地址</span>
							<label><input type="text" name="address" class="form-control"  value="{{$data->address}}" aria-describedby="sizing-addon2"></label>
						</div>
						<div class="input-group user-form-group">
							<span class="input-group-addon" id="sizing-addon2">性别</span>
							<label><input type="radio" name="sex" value="1" 
							<?php echo $data->sex==1? 'checked':'';?>><i class="iconfont icon-radio"></i> 男士
							</label>
							<label><input type="radio" name="sex" value="2" 
							<?php echo $data->sex==2?'checked':''; ?>><i class="iconfont icon-radio"></i> 女士
							</label>
							<label><input type="radio" name="sex" value="3" 
							<?php echo $data->sex==3? 'checked':'';?>><i class="iconfont icon-radio"></i> 保密
							</label>
						</div>
						<div class="input-group user-form-group">
							<span class="input-group-addon" id="sizing-addon2">年龄</span>
							<label><input type="text" name="age" class="form-control"  value="{{$data->age}}" aria-describedby="sizing-addon2"></label>
						</div> -->
						<div class="user-form-group">
							<button type="submit" class="btn">确认修改</button>
						</div>
					</form>
					<script src="js/zebra.datepicker.min.js"></script>
					<link rel="stylesheet" href="css/zebra.datepicker.css">
					<script>
						$('input.datepicker').Zebra_DatePicker({
							default_position: 'below',
							show_clear_date: false,
							show_select_today: false,
						});
					</script>
				</div>
			</div>
		</section>
	</div>
@endsection
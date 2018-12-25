@extends('home.layouts.public')
<title>@yield('title','个人中心 - 个人资料')</title>
	@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			@include('home.layouts.sidebar')
			<style>
		.file {
			position: relative;
			display: inline-block;
			background: #D0EEFF;
			border: 1px solid #99D3F5;
			border-radius: 4px;
			padding: 4px 12px;
			overflow: hidden;
			color: #1E88C7;
			text-decoration: none;
			text-indent: 0;
			line-height: 20px;
		}
		.file input {
			position: absolute;
			font-size: 100px;
			right: 0;
			top: 0;
			opacity: 0;
		}
		.file:hover {
			background: #AADFFD;
			border-color: #78C3F3;
			color: #004974;
			text-decoration: none;
		}
			</style>
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
					<div class="port b-r50" id="crop-avatar">
						<div class="img"><img src="/home/images/icons/default_avt.png" class="cover b-r50"></div>
					</div>
					<form action="/user/info" method="post" class="user-setting__form" role="form" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="input-group user-form-group">
							<span class="input-group-addon" id="sizing-addon2">用户名</span>
							<label><input type="text" name="username" class="form-control"  value="{{session('username')}}"></label>
						</div>
						<div class="input-group user-form-group">
							<label class="input-group-addon">地址</label>
							<label><input type="text" class="form-control" name="address" placeholder="请填写地址"></label>
						</div>
						<div class="input-group user-form-group ">
							<label class="input-group-addon">性别：</label>
							<label><input type="radio" name="sex" value="1"><i class="iconfont icon-radio"></i> 男士</label>
							<label><input type="radio" name="sex" value="2"><i class="iconfont icon-radio"></i> 女士</label>
							<label><input type="radio" name="sex" value="3" checked><i class="iconfont icon-radio"></i> 保密</label>
						</div>
						<div class="input-group user-form-group">
							<label class="input-group-addon">年龄：</label>
							<label><input type="text" class="form-control" name="age" placeholder="请填写年龄"></label>
						</div>
						<div class="input-group user-form-group">
							<label class="input-group-addon">头像：</label>
							<label><a href="javascript:;" class="file">选择文件
    						<input type="file" name="pic" id=""></a></label>
						</div>
						<div class="user-form-group">
							<button type="submit" class="btn">确认</button>
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
	<!-- 头像选择模态框 -->
	<link href="/home/css/cropper/cropper.min.css" rel="stylesheet">
	<link href="/home/css/cropper/sitelogo.css" rel="stylesheet">
	<script src="/home/js/cropper/cropper.min.js"></script>
	<script src="/home/js/cropper/sitelogo.js"></script>
	<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form class="avatar-form" action="/user/info" enctype="multipart/form-data" method="post">
				{{csrf_field()}}
					<div class="modal-header">
						<button class="close" data-dismiss="modal" type="submit">&times;</button>
						<h4 class="modal-title" id="avatar-modal-label">Change Logo Picture</h4>
					</div>
					<div class="modal-body">
						<div class="avatar-body">
							<div class="avatar-upload">
								<input class="avatar-src" name="avatar_src" type="hidden">
								<input class="avatar-data" name="avatar_data" type="hidden">
								<label for="avatarInput">图片上传</label>
								<input class="avatar-input" id="avatarInput" name="pic" type="file"></div>
							<div class="row">
								<div class="col-md-9">
									<div class="avatar-wrapper"></div>
								</div>
								<div class="col-md-3">
									<div class="avatar-preview preview-lg"></div>
									<div class="avatar-preview preview-md"></div>
									<div class="avatar-preview preview-sm"></div>
								</div>
							</div>
							<div class="row avatar-btns">
								<div class="col-md-9">
									<div class="btn-group">
										<button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"><i class="fa fa-undo"></i> 向左旋转</button>
									</div>
									<div class="btn-group">
										<button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> 向右旋转</button>
									</div>
								</div>
								<div class="col-md-3">
									<button class="btn btn-success btn-block avatar-save" type="submit"><i class="fa fa-save"></i> 保存修改</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
	@endsection
@extends('home.layouts.public')
<title>@yield('title','个人中心 - 个人资料')</title>
	@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			@include('home.layouts.sidebar')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">账户信息</div>
					<div class="port b-r50" id="crop-avatar">
						<div class="img"><img src="/home/images/icons/default_avt.png" class="cover b-r50"></div>
					</div>
					<form action="" class="user-setting__form" role="form">
						<div class="user-form-group">
							<label for="user-id">用户名：</label>
							<input type="text" id="user-id" value="18759808122" placeholder="请输入您的昵称">
						</div>
						<div class="user-form-group">
							<label>等级：</label>
							普通会员 <a href="agent_level.html">提升</a>
						</div>
						<div class="user-form-group">
							<label>性别：</label>
							<label><input type="radio" name="sex" value="M"><i class="iconfont icon-radio"></i> 男士</label>
							<label><input type="radio" name="sex" value="W"><i class="iconfont icon-radio"></i> 女士</label>
							<label><input type="radio" name="sex" value="S" checked><i class="iconfont icon-radio"></i> 保密</label>
						</div>
						<div class="user-form-group">
							<label>生日：</label>
							<label><input type="text" class="datepicker" value="1993-02-15" placeholder="请选择您的出生日期"></label>
						</div>
						<div class="user-form-group">
							<button type="button" class="btn">确认修改</button>
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
				<form class="avatar-form" action="{%url('admin/upload-logo')%}" enctype="multipart/form-data" method="post">
					<div class="modal-header">
						<button class="close" data-dismiss="modal" type="button">&times;</button>
						<h4 class="modal-title" id="avatar-modal-label">Change Logo Picture</h4>
					</div>
					<div class="modal-body">
						<div class="avatar-body">
							<div class="avatar-upload">
								<input class="avatar-src" name="avatar_src" type="hidden">
								<input class="avatar-data" name="avatar_data" type="hidden">
								<label for="avatarInput">图片上传</label>
								<input class="avatar-input" id="avatarInput" name="avatar_file" type="file"></div>
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
	<!-- 继承模版 -->
	@extends('home.layouts.public')

	<title>@yield('title','登陆/注册')</title>
	
	@section('css')
	<link rel="stylesheet" href="/home/css/iconfont.css">
	<link rel="stylesheet" href="/home/css/global.css">
	<link rel="stylesheet" href="/home/css/bootstrap.min.css">
	<link rel="stylesheet" href="/home/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/home/css/login.css">
	<link rel="stylesheet" href="/home/css/swiper.min.css">
	<link rel="stylesheet" href="/home/css/styles.css">
	<script src="/home/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
	<script src="/home/js/bootstrap.min.js" charset="UTF-8"></script>
	<script src="/home/js/swiper.min.js" charset="UTF-8"></script>
	<script src="/home/js/jquery.form.js" charset="UTF-8"></script>
	<script src="/home/js/global.js" charset="UTF-8"></script>
	<script src="/home/js/login.js" charset="UTF-8"></script>
	<script src="/home/js/jquery.DJMask.2.1.1.js" charset="UTF-8"></script>
	@endsection

	@section('main')
	
			<div style="background:url(/home/images/login_bg.jpg) no-repeat center center; ">
		<div class="login-layout container">
			<div class="form-box login">
				<div class="tabs-nav">
					<h2>欢迎登录U袋网平台</h2>
				</div>
				<div class="tabs_container">
				
					<form class="tabs_form" action="/doreset" method="post" id="login_form">
					{{csrf_field()}}
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
								</div>
								<input class="form-control password" name="password" id="login_pwd" placeholder="请输入密码" autocomplete="off" type="password">
								<div class="input-group-addon pwd-toggle" title="显示密码"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
								</div>
								<input class="form-control password" name="repassword" id="login_pwd" placeholder="请输入密码" autocomplete="off" type="password">
								<div class="input-group-addon pwd-toggle" title="显示密码"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></div>
							</div>
						</div>
						
	                    <!-- 错误信息 -->
	                    @if(session('error'))
						<div class="form-group">
							<div class="error_msg" id="login_error">
								<!-- 错误信息 范例html -->
								<div class="alert alert-warning alert-dismissible fade in" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>{{session('error')}}</strong>
								</div>
								
							</div>
						</div>
						@endif
						<input type="hidden" name="user_id" value="{{$id}}">
	                    <button class="btn btn-large btn-primary btn-lg btn-block submit" id="login_submit" type="submit">重置密码</button><br>
                    </form>
                    <div class="tabs_div">
	                    <div class="success-box">
	                    	<div class="success-msg">
								<i class="success-icon"></i>
	                    		<p class="success-text">登录成功</p>
	                    	</div>
	                    </div>
	                    <div class="option-box">
	                    	<div class="buts-title">
	                    		现在您可以
	                    	</div>
	                    	<div class="buts-box">
	                    		<a role="button" href="index.html" class="btn btn-block btn-lg btn-default">继续访问商城</a>
								<a role="button" href="udai_welcome.html" class="btn btn-block btn-lg btn-info">登录会员中心</a>
	                    	</div>
	                    </div>
                    </div>
                </div>
			</div>
			<script>
				$(document).ready(function() {
					// 判断直接进入哪个页面 例如 login.php?p=register
					switch($.getUrlParam('p')) {
						case 'register': $('.register').show(); break;
						case 'resetpwd': $('.resetpwd').show(); break;
						default: $('.login').show();
					};
					// 发送验证码事件
					$('.getsms').click(function() {
						var phone = $(this).parents('form').find('input.phone');
						var error = $(this).parents('form').find('.error_msg');
						switch(phone.validatemobile()) {
							case 0:
								// 短信验证码的php请求
								error.html(msgtemp('验证码 <strong>已发送</strong>','alert-success'));
								$(this).rewire(60);
							break;
							case 1: error.html(msgtemp('<strong>手机号码为空</strong> 请输入手机号码',    'alert-warning')); break;
							case 2: error.html(msgtemp('<strong>手机号码错误</strong> 请输入11位数的号码','alert-warning')); break;
							case 3: error.html(msgtemp('<strong>手机号码错误</strong> 请输入正确的号码',  'alert-warning')); break;
						}
					});
					// 以下确定按钮仅供参考
					$('.submit').click(function() {
						var form = $(this).parents('form')
						var phone = form.find('input.phone');
						var pwd = form.find('input.password');
						var error = form.find('.error_msg');
						var success = form.siblings('.tabs_div');
						var options = {
							beforeSubmit: function () {
								console.log('喵喵喵')
							},
							success: function (data) {
								console.log(data)
							}
						}
						// 验证手机号参考这个
						switch(phone.validatemobile()) {
							case 1: error.html(msgtemp('<strong>手机号码为空</strong> 请输入手机号码',    'alert-warning')); return; break;
							case 2: error.html(msgtemp('<strong>手机号码错误</strong> 请输入11位数的号码','alert-warning')); return; break;
							case 3: error.html(msgtemp('<strong>手机号码错误</strong> 请输入正确的号码',  'alert-warning')); return; break;
						}
						// 验证密码复杂度参考这个
						switch(pwd.validatepwd()) {
							case 1: error.html(msgtemp('<strong>密码不能为空</strong> 请输入密码',    'alert-warning')); return; break;
							case 2: error.html(msgtemp('<strong>密码过短</strong> 请输入6位以上的密码','alert-warning')); return; break;
							case 3: error.html(msgtemp('<strong>密码过于简单</strong><br>密码需为字母、数字或特殊字符组合',  'alert-warning')); return; break;
						}
						form.ajaxForm(options);
						// 请求成功执行类似这样的事件
						// form.fadeOut(150,function() {
						// 	success.fadeIn(150);
						// });
					})
				});
			</script>
		</div>
	</div>
	@endsection
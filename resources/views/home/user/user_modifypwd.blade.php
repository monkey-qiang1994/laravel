@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
			<!-- 引入侧边栏 -->
			@include('home.layouts.sidebar')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">账户信息-修改登陆密码</div>
					<div class="modify_div">
						<div class="clearfix">
							<a href="udai_modifypwd_step1.html" role="button" class="but">修改登陆密码</a>
							<a href="login.html?p=resetpwd" role="button" class="but">忘记登陆密码</a>
						</div>
						<div class="help-block">随时都能更改密码，保障您账户的安全</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
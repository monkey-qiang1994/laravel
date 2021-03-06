<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	@section('css')
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" href="/home/css/iconfont.css">
	<link rel="stylesheet" href="/home/css/global.css">
	<link rel="stylesheet" href="/home/css/bootstrap.min.css">
	<link rel="stylesheet" href="/home/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/home/css/swiper.min.css">
	<link rel="stylesheet" href="/home/css/styles.css">
	<script src="/home/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
	<script src="/home/js/bootstrap.min.js" charset="UTF-8"></script>
	<script src="/home/js/swiper.min.js" charset="UTF-8"></script>
	<script src="/home/js/global.js" charset="UTF-8"></script>
	<script src="/home/js/jquery.DJMask.2.1.1.js" charset="UTF-8"></script>
	@show
	<!-- 导航栏样式 -->
	<link rel="stylesheet" href="/home/css/menu/style.css">
	<!--
	<script src="/home/js/menu/jquery-latest.min.js" charset="UTF-8"></script>
	<script src="/home/js/menu/script.js" charset="UTF-8"></script>
	-->
	<style>
		.required{
			color: red;
		}
	</style>
	<title>@yield('title')</title>
</head>
<body>
	<!-- 顶部tab -->
	<div class="tab-header">
		<div class="inner">
			<div class="pull-left">
				<div class="pull-left">嗨，欢迎来到<span class="cr">时尚网</span></div>
			</div>
			<div class="pull-right">
			@if(session('username'))
				<a href="/user/welcome"><span class="cr">{{session('username')}}</span></a><a href="/login"><span class="cr">退出</span></a>
			@else
				<a href="/login/create"><span class="cr">登录</span></a>
				<a href="/login/create?p=register">注册</a>
			@endif	

				<a href="/user/welcome">我的U袋</a>
				<a href="/user/my_order">我的订单</a>
			</div>
		</div>
	</div>
	<!-- 搜索栏 -->
	<div class="top-search">
		<div class="inner">
			<a class="logo" href="http://www.laravel.com/"><img src="/home/images/icons/logo.jpg" alt="U袋网" class="cover"></a>
			<div class="search-box">
				<form class="input-group" action="list" method="get">
					<input placeholder="请输入关键词" type="text" name="keyword">
					<span class="input-group-btn">
						<button type="submit">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button>
					</span>
				</form>
				<p class="help-block text-nowrap">
					<a href="http://www.laravel.com/list?cate_id=17">连衣裙</a>
					<a href="http://www.laravel.com/list?cate_id=8">牛仔裤</a>
					<a href="http://www.laravel.com/list?cate_id=16">衬衫</a>
					<a href="http://www.laravel.com/list?cate_id=14">T恤</a>
					<a href="http://www.laravel.com/list?cate_id=5">女包</a>
					<a href="http://www.laravel.com/list?cate_id=4">活力童装</a>
				</p>
			</div>
			<div class="cart-box">
				<a href="/cart" class="cart-but">
					<i class="iconfont icon-shopcart cr fz16"></i> 购物车 {{$cart_num}} 件
				</a>
			</div>
		</div>
	</div>
	<!-- 首页导航栏 -->
	<div class="top-nav bg3">
		<div class="nav-box inner">
			<!-- <ul class="nva-list">
				<a href="http://www.laravel.com/"><li class="active">首页</li></a>
				<a href="/list"><li>商品列表</li></a>
				<a href="temp_article/udai_article5.html"><li>新手上路</li></a>
				<a href="class_room.html"><li>U袋学堂</li></a>
				<a href="enterprise_id.html"><li>企业账号</li></a>
				<a href="udai_contract.html"><li>诚信合约</li></a>
				<a href="/contact"><li>联系我们</li></a>
			</ul> -->
		
		<div id='nav-menu'>
			<ul>
				<li><a href="http://www.laravel.com/">首页</a></li>
				@foreach($cate as $k=>$row)

				<!-- 判断是否有子类 -->
				@if(count($row->sub))
				   <li class='active has-sub'>
				 @else
				 	<li>
				 @endif
				<!-- 判断结束 -->

				   <a href='/list?cate_id={{$row->cate_id}}'>{{$row->cate_name}}</a>
				   	@if(count($row->sub))
				      <ul>
				      	@foreach($row->sub as $rows)

				      	<!-- 判断是否有子类 -->
				      	@if(count($rows->sub))
				         <li class='has-sub'>
				        @else
				         <li>
				        @endif
						<!-- 判断结束 -->

				         <a href='/list?cate_id={{$rows->cate_id}}'>{{$rows->cate_name}}</a>
				         	@if(count($rows->sub))
				            <ul>
				            	@foreach($rows->sub as $rowss)
				               <li><a href='/list?cate_id={{$rowss->cate_id}}'>{{$rowss->cate_name}}</a></li>
				               	@endforeach
				            </ul>
				            @endif
				         </li>
				         @endforeach
				      </ul>
				    @endif
				   </li>
				@endforeach
				<li><a href="/contact">联系我们</a></li>
			</ul>
		</div>

		</div>
	</div>
	@section('main')
	
	@show

	<!-- 底部信息 -->
	<div class="footer">
		<div class="footer-tags">
			<div class="tags-box inner">
				<div class="tag-div">
					<img src="/home/images/icons/footer_1.gif" alt="厂家直供">
				</div>
				<div class="tag-div">
					<img src="/home/images/icons/footer_2.gif" alt="一件代发">
				</div>
				<div class="tag-div">
					<img src="/home/images/icons/footer_3.gif" alt="美工活动支持">
				</div>
				<div class="tag-div">
					<img src="/home/images/icons/footer_4.gif" alt="信誉认证">
				</div>
			</div>
		</div>
		<div class="footer-links inner">
			<dl>
				<dt>U袋网</dt>
				<a href="temp_article/udai_article10.html"><dd>企业简介</dd></a>
				<a href="temp_article/udai_article11.html"><dd>加入U袋</dd></a>
				<a href="temp_article/udai_article12.html"><dd>隐私说明</dd></a>
			</dl>
			<dl>
				<dt>服务中心</dt>
				<a href="temp_article/udai_article1.html"><dd>售后服务</dd></a>
				<a href="temp_article/udai_article2.html"><dd>配送服务</dd></a>
				<a href="temp_article/udai_article3.html"><dd>用户协议</dd></a>
				<a href="temp_article/udai_article4.html"><dd>常见问题</dd></a>
			</dl>
			<dl>
				<dt>新手上路</dt>
				<a href="temp_article/udai_article5.html"><dd>如何成为代理商</dd></a>
				<a href="temp_article/udai_article6.html"><dd>代销商上架教程</dd></a>
				<a href="temp_article/udai_article7.html"><dd>分销商常见问题</dd></a>
				<a href="temp_article/udai_article8.html"><dd>付款账户</dd></a>
			</dl>
		</div>
		<div class="copy-box clearfix">
			<ul class="copy-links">
				<a href="agent_level.html"><li>网店代销</li></a>
				<a href="/links"><li>友情链接</li></a>
				<a href="/contact"><li>联系我们</li></a>
				<a href="temp_article/udai_article10.html"><li>企业简介</li></a>
				<a href="temp_article/udai_article5.html"><li>新手上路</li></a>
			</ul>
			<!-- 版权 -->
			<p class="copyright">
				© 2005-2017 U袋网 版权所有，并保留所有权利<br>
				ICP备案证书号：闽ICP备16015525号-2&nbsp;&nbsp;&nbsp;&nbsp;福建省宁德市福鼎市南下村小区（锦昌阁）1栋1梯602室&nbsp;&nbsp;&nbsp;&nbsp;Tel: 18650406668&nbsp;&nbsp;&nbsp;&nbsp;E-mail: 18650406668@qq.com
			</p>
		</div>
	</div>
</body>



</html>

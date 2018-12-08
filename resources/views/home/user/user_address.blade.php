@extends('home.layouts.public')
<title>@yield('title','个人中心')</title>
	@section('main')
	<div class="content clearfix bgf5">
		<section class="user-center inner clearfix">
		<!-- 引入侧边栏 -->
			@include('home.layouts.sidebar')
			<div class="pull-right">
				<div class="user-content__box clearfix bgf">
					<div class="title">账户信息-收货地址</div>
					<form action="" class="user-addr__form form-horizontal" role="form">
						<p class="fz18 cr">新增收货地址<span class="c6" style="margin-left: 20px">电话号码、手机号码选填一项，其余均为必填项</span></p>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">收货人姓名：</label>
							<div class="col-sm-6">
								<input class="form-control" id="name" placeholder="请输入姓名" type="text">
							</div>
						</div>
						<div class="form-group">
							<label for="details" class="col-sm-2 control-label">收货地址：</label>
							<div class="col-sm-10">
								<div class="addr-linkage">
									<select name="province"></select>
									<select name="city"></select>
									<select name="area"></select>
									<select name="town"></select>
								</div>
								<input class="form-control" id="details" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码等信息" maxlength="30" type="text">
							</div>
						</div>
						<!-- <div class="form-group">
							<label for="code" class="col-sm-2 control-label">地区编码：</label>
							<div class="col-sm-6">
								<input class="form-control" id="code" placeholder="请输入邮政编码" type="text">
							</div>
						</div> -->
						<div class="form-group">
							<label for="mobile" class="col-sm-2 control-label">手机号码：</label>
							<div class="col-sm-6">
								<input class="form-control" id="mobile" placeholder="请输入手机号码" type="text">
							</div>
						</div>
						<div class="form-group">
							<label for="phone" class="col-sm-2 control-label">电话号码：</label>
							<div class="col-sm-6">
								<input class="form-control" id="phone" placeholder="请输入电话号码" type="text">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<div class="checkbox">
									<label><input type="checkbox"><i></i> 设为默认收货地址</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<button type="submit" class="but">保存</button>
							</div>
						</div>
						<script src="/home/js/jquery.citys.js"></script>
						<script>
							$(document).ready(function(){
								// 添加街道/乡镇
								function townFormat(info){
									$('.addr-linkage select[name="town"]').hide().empty();
									if (info['code'] % 1e4 && info['code'] < 7e6){	//是否为“区”且不是港澳台地区
										var ajaxConfig = {
											url: 'http://passer-by.com/data_location/town/' + info['code'] + '.json',
											scriptCharset:'UTF-8',
											dataType: "json",
											timeout: 4000,
											success: function(data) {
												$('.addr-linkage select[name="town"]').show();
												// $('#code').val(info['code']) // 填地区编码
												for (i in data) {
													$('.addr-linkage select[name="town"]').append(
														'<option value="' + data[i] + '">' + data[i] + '</option>'
													);
												}
											},
										};
										$.ajax(ajaxConfig).fail(function(p1,p2,p3){
											ajaxConfig.url = 'js/data_location/town/' + info['code'] + '.json';
											$.ajax(ajaxConfig)
										});
									}
								};
								$('.addr-linkage').citys({
									// 如果某天这个仓库地址失效了dataUrl请使用本地 2017.10 的数据 'js/data_location/list.json'
									dataUrl: 'http://passer-by.com/data_location/list.json',
									spareUrl: '/home/js/data_location/list.json',
									dataType: 'json',
									valueType: 'name',
									province: remote_ip_info['province'],
									city: remote_ip_info['city'],
									area: remote_ip_info['district'],
									onChange: function(data) {
										townFormat(data)
									},
								},function(api){
									var info = api.getInfo();
									townFormat(info);
								});
							}); 
						</script>
					</form>
					<p class="fz18 cr">已保存的有效地址</p>

					<div class="table-thead addr-thead">
						<div class="tdf1">收货人</div>
						<div class="tdf2">所在地</div>
						<div class="tdf3"><div class="tdt-a_l">详细地址</div></div>
						<!-- <div class="tdf1">邮编</div> -->
						<div class="tdf1">电话/手机</div>
						<div class="tdf1">操作</div>
						<div class="tdf1"></div>
					</div>
					<div class="addr-list">
						<div class="addr-item">
							<div class="tdf1">喵喵喵</div>
							<div class="tdf2 tdt-a_l">福建省 福州市 晋安区</div>
							<div class="tdf3 tdt-a_l">浦下村74号</div>
							<!-- <div class="tdf1">350111</div> -->
							<div class="tdf1">153****7649</div>
							<div class="tdf1 order">
								<a href="address/1/edit">修改</a><a href="">删除</a>
							</div>
							<div class="tdf1">
								<a href="" class="default active">默认地址</a>
							</div>
						</div>
						<div class="addr-item">
							<div class="tdf1">喵污喵⑤</div>
							<div class="tdf2 tdt-a_l">福建省 福州市 仓山区 建新镇</div>
							<div class="tdf3 tdt-a_l">建新中心小学</div>
							<!-- <div class="tdf1">350104</div> -->
							<div class="tdf1">153****7649</div>
							<div class="tdf1 order">
								<a href="udai_address_edit.html">修改</a><a href="">删除</a>
							</div>
							<div class="tdf1">
								<a href="" class="default">设为默认</a>
							</div>
						</div>
						<div class="addr-item">
							<div class="tdf1">taroxd</div>
							<div class="tdf2 tdt-a_l">福建省 福州市 鼓楼区 鼓东街道</div>
							<div class="tdf3 tdt-a_l">世界金龙大厦20层B北 福州腾讯企点运营中心</div>
							<!-- <div class="tdf1">350104</div> -->
							<div class="tdf1">153****7649</div>
							<div class="tdf1 order">
								<a href="udai_address_edit.html">修改</a><a href="">删除</a>
							</div>
							<div class="tdf1">
								<a href="" class="default">设为默认</a>
							</div>
						</div>
						<div class="addr-item">
							<div class="tdf1">VIPArcher</div>
							<div class="tdf2 tdt-a_l">福建省 福州市 仓山区 建新镇</div>
							<div class="tdf3 tdt-a_l">详细地址</div>
							<!-- <div class="tdf1">350104</div> -->
							<div class="tdf1">153****7649</div>
							<div class="tdf1 order">
								<a href="udai_address_edit.html">修改</a><a href="">删除</a>
							</div>
							<div class="tdf1">
								<a href="" class="default">设为默认</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@endsection
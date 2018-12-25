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
					@if(session('success'))
						<div class="alert alert-success alert-dismissible" role="alert">
						 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>	
						{{session('success')}}</div>
					@elseif(session('error'))
						<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{session('error')}}</div>
					@endif
					<form action="/user/address" class="user-addr__form form-horizontal" role="form" method="post">
					{{csrf_field()}}
						<p class="fz18 cr">新增收货地址<span class="c6" style="margin-left: 20px">收货人姓名,收货地址,手机号码选填一项，其余均为必填项</span></p>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">收货人姓名：</label>
							<div class="col-sm-6">
								<input class="form-control" name="consignee" id="name" placeholder="请输入真实姓名" type="text">
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
								<input class="form-control" name="address" id="details" placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码等信息" maxlength="30" type="text">
							</div>
						</div>
						<div class="form-group">
							<label for="mobile" class="col-sm-2 control-label">手机号码：</label>
							<div class="col-sm-6">
								<input class="form-control" name="phone" id="mobile" placeholder="请输入手机号码" type="text">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-6">
								<div class="checkbox">
									<label><input type="checkbox" name="checkbox"><i></i> 设为默认收货地址</label>
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
									province: '',
									city:'',
									area: '',
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
						<div class="tdf1" name="consignee">收货人</div>
						<div class="tdf2">所在地</div>
						<div class="tdf3"><div class="tdt-a_l">详细地址</div></div>
						<!-- <div class="tdf1">邮编</div> -->
						<div class="tdf1" name="phone">电话/手机</div>
						<div class="tdf1">操作</div>
						<div class="tdf1"></div>
					</div>
					@foreach($info as $k=>$v)
				
					<div class="addr-list">
						<div class="addr-item">
							<div class="tdf1">{{$v->consignee}}</div>
							<div class="tdf2 tdt-a_l">{{$v->province}}{{$v->city}}{{$v->area}}{{$v->town}}</div>
							<div class="tdf3 tdt-a_l">{{$v->address}}</div>
							<!-- <div class="tdf1">350111</div> -->
							<div class="tdf1">{{$v->phone}}</div>
							<div class="tdf1 order">
								<form action="/user/address/{{$v->add_id}}" method="post">
								{{csrf_field()}}
								{{method_field('DELETE')}}
									<button type="submit" class="default active">删除</button>
								</form>
							</div>
							<div class="tdf1">
							@if($v->status==1)
								<a href="/user/moren/{{$v->add_id}}" class="label label-success" style="padding: 10px">默认地址</a>
							@else
								<a href="/user/moren/{{$v->add_id}}" class="label label-danger" style="padding: 10px">设置为默认地址</a>
							@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</section>
	</div>
@endsection
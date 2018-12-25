<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="../admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="../admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="../admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="../admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<style type="text/css">
	.text-c .btn {
    float: left;
    margin-left: 10px;
	}
</style>
<title>会员管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
@if(session('success'))
	<div class="Huialert Huialert-success"><i class="Hui-iconfont">&#xe6a6;</i>{{(session('success'))}}</div>
@elseif(session('error'))
	<div class="Huialert Huialert-error"><i class="Hui-iconfont">&#xe6a6;</i>{{(session('error'))}}</div>
@endif
<div class="page-container">
	<div class="text-c"> 
		<!-- 搜索 -->
		<form action="/adminx/member_list" method="get">
		<input type="text" class="input-text" style="width:250px" placeholder="输入会员名称" name="keywords" value="{{$request['keywords'] or ''}}">
		<button type="submit" class="btn btn-success radius"><i class="Hui-iconfont" style="float: none;">&#xe665;</i> 搜用户</button>
		</form>
		<!-- 搜索结束 -->
	</div>
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>  <span class="r">共有数据：<strong>88</strong> 条</span> </div>
	<div class="mt-20">
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="80">ID</th>
				<th width="100">用户名</th>
				<th width="90">手机</th>
				<th width="150">邮箱</th>
				<th width="130">加入时间1</th>
				<th width="70">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
		@foreach($user as $row)
			<tr class="text-c">
				<td><input type="checkbox" value="" name=""></td>
				<td>{{$row->user_id}}</td>
				<td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','360','400')">{{$row->username}}</u></td>
				<td>{{$row->phone}}</td>
				<td>{{$row->email}}</td>
				<td>{{$row->created_at}}</td>
				<td class="td-status">
				@if($row->status == 1)
					<span class="label label-success radius">已启用</span>
				@elseif($row->status == 0)
					<span class="label label-warning radius">已禁用</span>
				@endif
				</td>
				<td class="td-manage">
				<!-- 改状态 -->
				<a style="text-decoration:none" class="stop btn btn-warning radius size-MINI edit" title="状态" href="javascript:void(0);"><i class="Hui-iconfont">&#xe631;</i></a> 
				<!-- 删除 -->
				<form action="/adminx/member_list/{{$row->user_id}}" method="post">
					{{csrf_field()}}
					{{method_field('DELETE')}}
					<button class="btn btn-danger radius size-MINI" type="submit" style="text-decoration:none">删除</button>
				</form>
				<a title="编辑" href="javascript:void(0);" onclick="member_edit('编辑','member-add.html','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>  
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	<div class="page">
		{{$user->render()}}
	</div>
	</div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="../admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="../admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="../admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="../admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="../admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<!-- <script type="text/javascript" src="../admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>  -->
<script type="text/javascript" src="../admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

/*用户-停用*/
$('.stop').click(function(){
	//获取id
	var tr = $(this).parents('tr');
	var id=$(this).parents('tr').find('td:eq(1)').html();
	// alert(id);
	//传id
	$.get('/adminx/member_list/'+id,{},function(data){
		//alert($data);
			
			
	});
		console.log($(tr).find('td:eq(6)').find('span').text());

	if($(tr).find('td:eq(6)').find('span').text()=='已禁用'){
		// alert(1);
		$(tr).find('td:eq(6)').html('<span class="label label-success radius">已启用</span>')
	}else{
		$(tr).find('td:eq(6)').html('<span class="label label-warning radius">已禁用</span>')
	}
	
});


</script> 
</body>
</html>
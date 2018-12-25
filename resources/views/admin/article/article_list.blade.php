<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 公告管理 <span class="c-gray en">&gt;</span> 公告列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
		<a href="/adminx/article_list/create" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加公告</a></span> 
		<span class="r">共有数据：<strong>{{count($res)}}</strong> 条</span> </div> 
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">员工列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">标题</th>
				<th width="90">栏目</th>
				<th width="150">创建者</th>
				<th width="130">加入时间</th>
				<th width="130">最后修改时间</th>
				<th width="100">状态</th>
				<th width="100">操作</th>
			</tr>
		</thead>
			@foreach($res as $v )
		<tbody>
			<tr class="text-c">
				<td><input type="checkbox" value="1" name=""></td>
				<td>{{$v->article_id}}</td>
				<td>{{$v->article_title}}</td>
				<td>{{$v->article_type}}</td>
				<td>{{$v->author}}</td>
				<td>{{$v->created_at}}</td>
				<td>{{$v->updated_at}}</td>
				@if($v->article_status == -1)
				<td class="td-status"><span class="label label-danger radius">审核不通过</span></td>
				@endif
				@if($v->article_status == 0)
				<td class="td-status"><span class="label label-warning radius">待审核</span></td>
				@endif
				@if($v->article_status == 1)
				<td class="td-status"><span class="label label-success radius"><a onclick="picture_edit('查看','/adminx/article_detail?id={{$v->article_id}}','10001')">已启用-查看</a></span></td>
				@endif
				@if($v->article_status == 2)
				<td class="td-status"><span class="label label-defaunt radius">已禁用</span></td>
				@endif
				<td class="td-manage">
					@if($v->article_status <= 0)
					
					<a title="审核" href="javascript:;" onclick="picture_edit('审核','/adminx/article_list/{{$v->article_id}}','10001')" style="text-decoration:none;font-size: 25px"><i class="Hui-iconfont">&#xe720;</i></a> 
					@else
					<a title="编辑" href="javascript:;" onclick="picture_edit('修改','/adminx/article_list/{{$v->article_id}}/edit','10001')" style="text-decoration:none;font-size: 25px"><i class="Hui-iconfont">&#xe6df;</i></a> 
		             <form action="/adminx/article_list/{{$v->article_id}}" method="post">
		              {{csrf_field()}}
		              {{method_field('DELETE')}}
		                <button style="text-decoration:none;font-size: 25px" class="  btn btn-link"  href="javascript:;" type="submit"><i class="Hui-iconfont">&#xe6e2;</i></button></td>
		            </form>
					@endif
			</tr>
		</tbody>
			@endforeach
	</table>
	@if(Session::has('success'))
    <div class="success" style="display: none">{{Session::get('success')}}</div>
    @endif

   	@if(Session::has('error'))
    <div class="error" style="display: none">{{Session::get('error')}}</div>
    @endif

</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*
	参数解释：
	title	标题
	url		请求的url
	id		需要操作的数据id
	w		弹出层宽度（缺省调默认值）
	h		弹出层高度（缺省调默认值）
*/

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

/*图片-添加*/
function picture_add(title,url){
  var index = layer.open({
    type: 2,
    title: title,
    content: url
  });
  layer.full(index);
}


/*图片-编辑*/
function picture_edit(title,url,id){
  var index = layer.open({
    type: 2,
    title: title,
    content: url
  });
  layer.full(index);
}

/*用户-查看*/
function member_show(title,url,id,w,h){
  layer_show(title,url,w,h);
}
/*管理员-增加*/

function admin_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*管理员-删除*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'POST',
			url: '',
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
			},
		});		
	});
}

/*管理员-编辑*/
function admin_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*管理员-停用*/
function admin_stop(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_start(this,id)" href="javascript:;" title="启用" style="text-decoration:none"><i class="Hui-iconfont">&#xe615;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">已禁用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*管理员-启用*/
function admin_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		//此处请求后台程序，下方是成功后的前台处理……
		
		
		$(obj).parents("tr").find(".td-manage").prepend('<a onClick="admin_stop(this,id)" href="javascript:;" title="停用" style="text-decoration:none"><i class="Hui-iconfont">&#xe631;</i></a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!', {icon: 6,time:1000});
	});
}
</script>
</body>
</html>
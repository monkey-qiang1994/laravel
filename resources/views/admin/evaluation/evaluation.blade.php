<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->

<title>意见反馈</title>
</head>
<body>
<div class="page-container">
  <div class="text-c"> 
    <form method="get" action="/adminx/evaluation">
      {{csrf_field()}}
      <input type="hidden" name="id" value="{{$product_id}}">
      按等级搜索：<span class="select-box" style="width: 20%;">
				<select class="select" size="1" name="keyword" >
					<option  selected disabled="disabled">按评价等级</option>
					<option value="0">好评</option>
					<option value="1">一般</option>
					<option value="2">差评</option> 
				</select>
				</span>
      <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
    </form>
  </div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="60">用户名</th>
					<th>订单号</th>
					<th>评价等级</th>
					<th>评价图片</th>
					<th width="200">评价内容</th>
					<th>订单支付时间</th>
					<th>评价时间</th>
				</tr>
			</thead>
			<tbody>
				@foreach($res as $res_v)
				<tr class="text-c">
					<td><input type="checkbox" value="1" name=""></td>
		         	<td><a href="javascript:;" onclick="member_show('张三','/adminx/order_user?id={{$res_v->user_id}}','10001','360','400')"><i class="avatar size-L radius"><img alt="" src="/admin/static/h-ui/images/ucnter/avatar-default-S.gif"></i></a></td>
		         	<td>{{$res_v->order_num}}</td>
		         	<td>
		         		@if($res_v->evaluation_grede == 0)
		         		<i class="Hui-iconfont" style="font-size: 25px">&#xe668;</i>
		         		<i class="Hui-iconfont" style="font-size: 25px">&#xe668;</i>
		         		<i class="Hui-iconfont" style="font-size: 25px">&#xe668;</i>
		         		@endif
		         		@if($res_v->evaluation_grede == 1)
		         		<i class="Hui-iconfont" style="font-size: 25px">&#xe656;</i>
		         		<i class="Hui-iconfont" style="font-size: 25px">&#xe656;</i>
		         		@endif
		         		@if($res_v->evaluation_grede == 2)
		         		<i class="Hui-iconfont" style="font-size: 25px">&#xe65f;</i>
		         		@endif
		         	</td>
		         	<td>
		         		@if(isset($res_v->pic_id))
		         		<img src="{{$arr[$res_v->evaluation_id]}}" style="width: 100px">
		         		@else
		         		<img src="" style="width: 100px">
		         		@endif
		         	</td>
		         	<td>{{$res_v->evaluation_connect}}</td>
		         	<td>{{Date('Y-m-d H:i:s',$res_v->pay_at)}}</td>
		         	<td>{{Date('Y-m-d H:i:s',$res_v->evaluation_time)}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="r">
			{{$res->appends($request)->render()}}
		</div>
	</div>
</div>
<script type="text/javascript">
  /*用户-查看*/
function member_show(title,url,id,w,h){
  layer_show(title,url,w,h);
}
</script>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>  
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
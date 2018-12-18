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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 评论管理 <span class="c-gray en">&gt;</span> 意见反馈 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="text-c"> 日期范围：
    <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
    -
    <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
    <input type="text" class="input-text" style="width:250px" placeholder="输入关键词" id="" name="">
    <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜意见</button>
  </div>
  <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> </span> <span class="r">共有数据：<strong>88</strong> 条</span> </div>
  <div class="mt-20">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
      <thead>
        <tr class="text-c">
          <th width="25"><input type="checkbox" name="" value=""></th>
          <th width="60">ID</th>
          <th width="60">用户名</th>
          <th>订单编号</th>
          <th>地址</th>
          <th>联系电话</th>
          <th>订单创建时间</th>
          <th>订单最后修改时间</th>
          <th>订单状态</th>
          <th width="100">操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach($res as $v)
        <tr class="text-c">
          <td><input type="checkbox" value="1" name=""></td>
          <td>{{$v->order_id}}</td>
          <td><a href="javascript:;" onclick="member_show('张三','/adminx/order_user?id={{$v->user_id}}','10001','360','400')"><i class="avatar size-L radius"><img alt="" src="/admin/static/h-ui/images/ucnter/avatar-default-S.gif"></i></a></td>
          <td>{{$v->order_num}}</td>
          <td>{{$v->address}}</td>
          <td>{{$v->phone}}</td>
          <td>{{$v->created_at}}</td>
          <td>{{$v->updated_at}}</td>
          @if($v->order_status == 0)
          <td class="td-status"><span class="label label-warning radius">待支付</span></td>
          @endif
          @if($v->order_status == 1)
          <td class="td-status"><span class="label label-secondary radius">待发货</span></td>
          @endif
          @if($v->order_status == 2)
          <td class="td-status"><span class="label label-success radius">待评价</span></td>
          @endif
          @if($v->order_status == 3)
          <td class="td-status"><span class="label label-primary radius">已完成</span></td>
          @endif           

          <td class="td-manage">
            <a href="javascript:;" style="text-decoration:none;font-size: 25px;" onclick="member_show('订单详情','/adminx/order_detail?id={{$v->order_id}}','10001','999','555')"><i class="Hui-iconfont">&#xe627;</i></a>
            @if($v->order_status == 1)
            <a style="text-decoration:none;font-size: 25px;"  class="ml-5" onclick="member_send('发货','codeing.html','1')" href="javascript:;" title="发货"><i class="Hui-iconfont">&#xe669;</i></a> 
            @endif
            <form action="/adminx/order_list/{{1}}" method="post">
              {{csrf_field()}}
              {{method_field('DELETE')}}
              <button style="text-decoration:none;font-size: 25px" class="  btn btn-link"  href="javascript:;" type="submit"><i class="Hui-iconfont">&#xe6e2;</i></button></td>
            </form>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

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
$(function(){
  $('.table-sort').dataTable({
    "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    "bStateSave": true,//状态保存
    "aoColumnDefs": [
      //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
      {"orderable":false,"aTargets":[0,2,4]}// 制定列不参与排序
    ]
  });

});
/*用户-添加*/
function member_add(title,url,w,h){
  layer_show(title,url,w,h);
}
/*用户-查看*/
function member_show(title,url,id,w,h){
  layer_show(title,url,w,h);
}
/*用户-停用*/
function member_stop(obj,id){
  layer.confirm('确认要停用吗？',function(index){
    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
    $(obj).remove();
    layer.msg('已停用!',{icon: 5,time:1000});
  });
}

/*用户-启用*/
function member_start(obj,id){
  layer.confirm('确认要启用吗？',function(index){
    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
    $(obj).remove();
    layer.msg('已启用!',{icon: 6,time:1000});
  });
}
/*用户-编辑*/
function member_edit(title,url,id,w,h){
  layer_show(title,url,w,h);
}
/*密码-修改*/
function change_password(title,url,id,w,h){
  layer_show(title,url,w,h);  
}

/*用户-删除*/
function member_send(obj,id){
  layer.confirm('确认发货吗?',function(index){
    $.ajax({
      type: 'POST',
      url: '',
      dataType: 'json',
      success: function(data){
        $(obj).parents("tr").remove();
        layer.msg('已发货!',{icon:1,time:1000});
      },
      error:function(data) {
        console.log(data.msg);
      },
    });   
  });
}
</script>
</body>
</html>
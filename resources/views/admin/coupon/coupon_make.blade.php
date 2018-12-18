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
<title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="text-c"> 日期范围：
    <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;">
    -
    <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
    <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
    <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
  </div>
  <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a><a class="btn btn-primary-outline btn-warning-outline radius" onclick="picture_add('生成','/adminx/coupon_make/create')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 生成优惠券</a></span> <span class="r">共有数据：<strong>88</strong> 条</span> </div>
  <div class="mt-20">
  <table class="table table-border table-bordered table-hover table-bg table-sort">
    <thead>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="80">ID</th>
        <th width="80">优惠券编码</th>
        <th width="100">优惠券说明</th>
        <th width="40">最低使用金额</th>
        <th width="90">优惠券金额</th>
        <th width="130">过期时间</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>
      @foreach($res as $v)
      <tr class="text-c">
        <td><input type="checkbox" value="1" name=""></td>
        <td>{{$v->coupon_id}}</td>
        <td>{{$v->coupon_num}}</td>
        <td>{{$v->coupon_caption}}</td>
        <td>{{$v->coupon_down}}</td>
        <td class="td-status"><span class="label label-success radius">{{$v->coupon_price}}</span></td>
        <td>{{Date('Y-m-d H:i:s',$v->coupon_time)}}</td>
        <td class="td-manage">
          <a style="text-decoration:none;font-size: 25px" class="ml-5" onclick="picture_add('发送','/adminx/coupon_send?id={{$v->coupon_id}}','10001')" href="javascript:;" title="发送" ><i class="Hui-iconfont">&#xe68a;</i></a>
           <form action="/adminx/coupon_make/{{$v->coupon_id}}" method="post">
            <input type="hidden" name="pic" value="">
            {{csrf_field()}}
            {{method_field('DELETE')}}
              <button style="text-decoration:none;font-size: 25px" class="  btn btn-link"  href="javascript:;" type="submit"><i class="Hui-iconfont">&#xe6e2;</i></button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @if(Session::has('success'))
    <div class="success" style="display: none">{{Session::get('success')}}</div>
    @endif

    @if(Session::has('error'))
    <div class="error" style="display: none">{{Session::get('error')}}</div>
    @endif
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
<script type="text/javascript" src="../admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="../admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
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
    $.ajax({
      type: 'POST',
      url: '',
      dataType: 'json',
      success: function(data){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
        $(obj).remove();
        layer.msg('已停用!',{icon: 5,time:1000});
      },
      error:function(data) {
        console.log(data.msg);
      },
    });   
  });
}

/*用户-启用*/
function member_start(obj,id){
  layer.confirm('确认要启用吗？',function(index){
    $.ajax({
      type: 'POST',
      url: '',
      dataType: 'json',
      success: function(data){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
        $(obj).remove();
        layer.msg('已启用!',{icon: 6,time:1000});
      },
      error:function(data) {
        console.log(data.msg);
      },
    });
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
function member_del(obj,id){
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
</script> 
</body>
</html>
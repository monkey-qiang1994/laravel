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
<title>图片列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 图片管理 <span class="c-gray en">&gt;</span> 图片列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="text-c">
    <input type="text" name="" id="" placeholder=" 图片名称" style="width:250px" class="input-text">
    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 按说明搜</button>
  </div>

  <div class="cl pd-5 bg-1 bk-gray mt-20"> 
    <span class="l"><a class="btn btn-primary-outline btn-warning-outline radius" onclick="picture_add('添加','/adminx/ads/create')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 图片添加</a></span> 
    <span class="r">共有数据：<strong>54</strong> 条</span> </div>


    @if(Session::has('success'))
    <div class="success">{{Session::get('success')}}</div>
    @endif
  <div class="mt-20">
    <table class="table table-border table-bordered table-bg table-hover table-sort">
      <thead>
        <tr class="text-c">
          <th width="80">ID</th>
          <th width="233">图片说明</th>
          <th width="100">位置</th>
          <th>图片</th>
          <th width="60">发布状态</th>
          <th width="100">操作</th>
        </tr>
      </thead>
      @foreach($info as $v)
      <tbody>
        <tr class="text-c">
          <td>{{$v->ads_id}}</td>
          <td>{{$v->ads_name}}</td>
          <td>{{$v->ads_position}}</td>
          <td><img src="../Uploads/{{$v->ads_path}}" style="height: 100px"></td>
          @if($v->ads_status == '0')
          <td class="td-status"><span class="label label-success radius">已发布</span></td>
          @else
          <td class="td-status"><span class="label label-defaunt radius">已下架</span></td>
          @endif
          <td class="td-manage">
            <a style="text-decoration:none;font-size: 25px" class="ml-5" onclick="picture_edit('编辑','/adminx/ads/{{$v->ads_id}}/edit','10001')" href="javascript:;" title="编辑" ><i class="Hui-iconfont">&#xe6df;</i></a>
             <form action="/adminx/ads/{{$v->ads_id}}" method="post">
              <input type="hidden" name="pic" value="{{$v->ads_path}}">
              {{csrf_field()}}
              {{method_field('DELETE')}}
                <button style="text-decoration:none;font-size: 25px" class="  btn btn-link"  href="javascript:;" type="submit"><i class="Hui-iconfont">&#xe6e2;</i></button>
            </form>
            </td>
        </tr>
      </tbody>
      @endforeach
    </table>
    
  </div>
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

  //提示信息
  var success = $('.success').html();
  function modaldemo(){
  $("#modal-demo").modal("show")}
      function modalalertdemo(){
      $.Huimodalalert(success,1000)}
  if (success) {
    modalalertdemo();
  }

</script>
<script type="text/javascript">

  function modalalertdemo(){
  $.Huimodalalert('添加成功',2000)
  }
  
</script>
<script type="text/javascript">

/*图片-添加*/
function picture_add(title,url){
  var index = layer.open({
    type: 2,
    title: title,
    content: url
  });
  layer.full(index);
}

/*图片-查看*/
function picture_show(title,url,id){
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

/*图片-删除*/
function picture_del(id){
  layer.confirm('确认要删除吗？',function(index){
    $.ajax({
      type: 'GET',
      url: '/adminx/ads/?id=id',
      dataType: 'json',
      success: function(data){
        $('#aa'+id).parents("tr").remove();
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
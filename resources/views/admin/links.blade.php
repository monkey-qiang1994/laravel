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
<title>友情链接管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 友情链接 <span class="c-gray en">&gt;</span> 友情链接管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

  @if(Session::has('success'))
    <div class="Huialert Huialert-success"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('success')}}</div>
  @elseif(Session::has('error'))
    <div class="Huialert Huialert-error"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('error')}}</div>
  @endif

  <div class="cl pd-5 bg-1 bk-gray mt-20">
  <span class="l">
    <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
  </span>
  <span class="r">共有数据：<strong>{{count($links)}}</strong> 条</span>
  </div>
  <div class="mt-20">
    <table class="table table-border table-bordered table-bg table-sort">
      <thead>
        <tr class="text-c">
          <th width="25"><input type="checkbox" name="" value=""></th>
          <th width="70">ID</th>
          <th width="80">网站名称</th>
          <th width="200">网站链接</th>
          <th width="120">联系邮箱</th>
          <th>具体描述</th>
          <th width="100">状态</th>
          <th width="100">操作</th>
        </tr>
      </thead>
      <tbody>
        @foreach($links as $link)
        <tr class="text-c">
          <td class="text-c"><input name="" type="checkbox" value=""></td>
          <td class="text-c">{{$link->link_id}}</td>
          <td class="text-c">{{$link->web_name}}</td>
          <td class="text-c">{{$link->web_link}}</td>
          <td class="text-c">{{$link->email}}</td>
          <td class="text-c">{{$link->introduction}}</td>
          <td class="text-c">
            <form action="links/{{$link->link_id}}" method="post">
                {{csrf_field()}}
                {{method_field('PUT')}}
                @if($link->status == 0)
                  <input type="hidden" name="display" value="1">
                  <button type="submit" class="btn btn-success radius btn-status">审核通过</button>
                @else
                  <input type="hidden" name="display" value="0">
                  <button type="submit" class="btn btn-danger radius btn-status">待审核</button>
                @endif
               </form>
          </td>
          <td class="f-14 text-c product-brand-manage">
             <form action="links/{{$link->link_id}}" method="post" style="display: initial;">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-danger radius" onclick="return confirm('确定要删除?');" style="float:none;"><i class="Hui-iconfont">&#xe6e2;</i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
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
$('.table-sort').dataTable({
  "aaSorting": [[ 1, "desc" ]],//默认第几个排序
  "bStateSave": true,//状态保存
  "aoColumnDefs": [
    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
    {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
  ]
});
</script>
</body>
</html>
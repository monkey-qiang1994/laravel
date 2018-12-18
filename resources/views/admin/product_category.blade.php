<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
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
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="../admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->

<title>分类列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 分类管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="cl pd-5 bg-1 bk-gray mt-20">
  <span class="l">
    <a href="javascript:;" onClick="modaldemo()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a>
    <a href="javascript:history.go(-1);" class="btn btn-success radius"><i class="Hui-iconfont">&#xe66b;</i> 返回</a>
  </span>
  <span class="r">共有数据：<strong>{{count($cate_list)}}</strong> 条</span>
  </div>
  
  <!-- 提示框 -->
  @if (count($errors) > 0)
    <div class="Huialert Huialert-error">
        @foreach ($errors->all() as $error)
            <i class="Hui-iconfont">&#xe6a6;</i>分类名称不能为空
        @endforeach
    </div>
  @endif

  @if(Session::has('success'))
  <div class="Huialert Huialert-success"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('success')}}</div>
  @elseif(Session::has('error'))
  <div class="Huialert Huialert-error"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('error')}}</div>
  @endif

  <table class="table table-border table-bordered table-bg">
    <thead>
      <tr>
        <th scope="col" colspan="9">分类列表</th>
      </tr>
      <tr class="text-c">
        <th width="40">ID</th>
        <th width="150">分类名称</th>
        <th width="90">父类ID</th>
        <th width="150">路径</th>
        <th width="90">状态</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>

    @foreach($result as $row)
      <tr class="text-c">
        <td>{{$row->cate_id}}</td>
        <td>{{$row->cate_name}}</td>
        <td>{{$row->pid}}</td>
        <td>{{$row->path}}</td>
        <td class="td-status">
        <form action="product_category/1" method="post">
          <input type="hidden" name="cate_id" value="{{$row->cate_id}}">
          <input type="hidden" name="cate_name" value="{{$row->cate_name}}">
          {{csrf_field()}}
          {{method_field('PUT')}}
        @if($row->display == 0)
          <input type="hidden" name="display" value="1">
          <button type="submit" class="btn btn-success radius btn-status">启用</button>
        @else
          <input type="hidden" name="display" value="0">
          <button type="submit" class="btn btn-danger radius btn-status">禁用</button>
        @endif
        </form>
       
        </td>
        <td class="td-manage">
        @if(in_array($row->cate_id,$pids))
          <a title="查看子类" href="product_category?pid={{$row->cate_id}}" class="btn btn-success radius"><i class="Hui-iconfont">&#xe709;</i></a>
        @endif
          <a title="编辑" href="javascript:void(0)" class="btn btn-primary radius edit"><i class="Hui-iconfont">&#xe6df;</i></a>
          <form action="product_category/{{$row->cate_id}}" method="post" style="display: initial;">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" class="btn btn-danger radius" onclick="return confirm('确定要删除?');"><i class="Hui-iconfont">&#xe6e2;</i></button>
          </form>
        </td>
      </tr>
    @endforeach

    </tbody>
  </table>

  <div class="page">
  {{$result->appends($request)->render()}}
  </div>
</div>

<!-- 添加分类窗口 -->
<div id="modal-demo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content radius">
      <div class="modal-header">
        <h3 class="modal-title">添加分类</h3>
        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
      </div>
      <form action="product_category" method="post">
        <div class="modal-body">

          上级分类: 
          <span class="select-box radius mt-20" style="width: 80%;padding-top: 0;margin-top: 0;">
            <select class="select" name="pid">
              <option value="0">顶级分类</option>
              @foreach($cate_list as $list)
              <option value="{{$list->cate_id}}">{{$list->cate_name}}</option>
              @endforeach
            </select>
          </span><br/><br/>

          分类名称: <input type="text" name="cate_name" class="input-text radius" style="width:80%"><br/><br/>
          

          是否激活:
          <div class="radio-box" style="padding-left: 0;">
            <input type="radio" class="radio" name="display" value="0" checked>
            <label for="radio-1">开启</label>
            <input type="radio" class="radio" name="display" value="1">
            <label for="radio-1">关闭</label>
          </div>
          <br/>

        </div>
        {{csrf_field()}}
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">确定</button>
          <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- 添加分类窗口结束 -->

<!-- 编辑分类窗口 -->
<div id="modal-demo-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content radius">
      <div class="modal-header">
        <h3 class="modal-title">编辑分类</h3>
        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
      </div>
      <form action="product_category/1" method="post">
        <input type="hidden" name="cate_id">
        <input type="hidden" name="path">
        <div class="modal-body">
          所属分类: 
          <span class="select-box radius mt-20" style="width: 80%;padding-top: 0;margin-top: 0;">
            <select class="select" name="pid">
              <option class="edit_option" value="0">顶级分类</option>
              @foreach($cate_list as $list)
              <option class="edit_option" value="{{$list->cate_id}}">{{$list->cate_name}}</option>
              @endforeach
            </select>
          </span><br/><br/>

          分类名称: <input type="text" name="cate_name" class="input-text radius edit_name" style="width:80%"><br/><br/>

        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">确定</button>
          <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
        </div>
      </form>
    </div>

  </div>
</div>
<!-- 编辑分类窗口结束 -->



<button id="edit" disabled="hidden" onclick="modaledit()"></button>
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
//添加分类框
function modaldemo(){
  $("#modal-demo").modal("show")};
//编辑分类框
function modaledit(){
  $("#modal-demo-edit").modal("show")
};
  //编辑弹框
  $('.edit').click(function(){
    //当前点击的ID
    id=$(this).parents("tr").find('td').eq(0).html();
    //当前点击的名称
    name=$(this).parents("tr").find('td').eq(1).html();
    //当前点击的父ID
    pid=$(this).parents("tr").find('td').eq(2).html();
    //当前点击的path
    path=$(this).parents("tr").find('td').eq(3).html();
    //找到class为select下面子元素option中value=当前父id的内容并选中
    $(".select").find("option[value="+pid+"]").attr("selected",true);

    $("input[name='cate_id']").val(id);
    $("input[name='path']").val(path);

    $('.edit_name').val(name);

    $("#modal-demo-edit").modal("show")
  });
  

</script>
</body>
</html>
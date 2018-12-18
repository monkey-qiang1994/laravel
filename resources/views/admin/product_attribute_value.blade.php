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

<title>属性列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 属性管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="cl pd-5 bg-1 bk-gray mt-20">
  <span class="l">
    <a href="javascript:;" onClick="modaldemo()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加属性</a>
    <a href="/adminx/product_attribute" class="btn btn-success radius"><i class="Hui-iconfont">&#xe66b;</i> 返回</a>
  </span>
  <span class="r">共有数据：<strong>{{count($att_value)}}</strong> 条属性</span>
  </div>
  
  <!-- 提示框 -->
  @if (count($errors) > 0)
    <div class="Huialert Huialert-error">
        @foreach ($errors->all() as $error)
            <i class="Hui-iconfont">&#xe6a6;</i>属性值不能为空
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
        <th scope="col" colspan="9">属性列表</th>
      </tr>
      <tr class="text-c">
        <th width="40">属性ID</th>
        <th width="150">属性名称</th>
        <th width="150">所属分类</th>
        <th width="100">操作</th>
      </tr>
    </thead>
    <tbody>

    @foreach($att_value as $row)
      <tr class="text-c">
        <td>{{$row->att_id}}</td>
        <td>{{$row->att_name}}</td>
        <td>{{$row->cate_att_id}}</td>
        <td class="td-manage">
          <a title="编辑" href="javascript:void(0)" class="btn btn-primary radius edit"><i class="Hui-iconfont">&#xe6df;</i></a>
          <form action="product_attribute/{{$row->att_id}}" method="post" style="display: initial;">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <input type="hidden" name="att_value" value="1">
          <button type="submit" class="btn btn-danger radius" onclick="return confirm('确定要删除?');"><i class="Hui-iconfont">&#xe6e2;</i></button>
          </form>
        </td>
      </tr>
    @endforeach

    </tbody>
  </table>
</div>

<!-- 添加分类窗口 -->
<div id="modal-demo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content radius">
      <div class="modal-header">
        <h3 class="modal-title">添加属性</h3>
        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
      </div>
      <form action="product_attribute" method="post">
        <div class="modal-body">
        所属分类:
        <span class="select-box radius mt-20" style="width: 80%;padding-top: 0;margin-top: 0;">
            <select class="select" name="cate_att_id">
              @foreach($att_list as $list)
              <option class="edit_option" value="{{$list->cate_att_id}}">{{$list->cate_att_name}}</option>
              @endforeach
            </select>
          </span><br/><br/>
          <!-- 这个隐藏域是为了判断添加的内容是属性还是属性分类的 -->
          <input type="hidden" name="att_value" value="1">
          分类名称: <input type="text" name="att_name" class="input-text radius" style="width:80%"><br/><br/>

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
        <h3 class="modal-title">编辑属性分类</h3>
        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
      </div>
      <form action="product_attribute/1" method="post">
        <input type="hidden" name="att_id">
        <div class="modal-body">
        所属分类:
        <span class="select-box radius mt-20" style="width: 80%;padding-top: 0;margin-top: 0;">
            <select class="select" name="cate_att_id">
              @foreach($att_list as $list)
              <option class="edit_option" value="{{$list->cate_att_id}}">{{$list->cate_att_name}}</option>
              @endforeach
            </select>
          </span><br/><br/>
          <!-- 这个隐藏域是为了判断更新的内容是属性还是属性分类的 -->
          <input type="hidden" name="att_value" value="1">

          属性分类名称: <input type="text" name="att_name" class="input-text radius edit_name" style="width:80%"><br/><br/>

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
    //当前所属分类
    pid=$(this).parents("tr").find('td').eq(2).html();

    $(".select").find("option[value="+pid+"]").attr("selected",true);

    $("input[name='att_id']").val(id);

    $('.edit_name').val(name);

    $("#modal-demo-edit").modal("show")
  });
  

</script>
</body>
</html>
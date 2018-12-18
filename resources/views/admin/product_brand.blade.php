<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />

<link rel="stylesheet" type="text/css" href="../admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="../admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/css/style.css" />

<style>
  .dataTables_length{
    display: none;
  }
  #DataTables_Table_0_filter{
    display: none;
  }
</style>
<title>品牌管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 品牌管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
  <div class="mt-20">

  <div class="cl pd-5 bg-1 bk-gray mt-20">
  <span class="l">
    <a href="javascript:;" onClick="modaldemo()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加品牌</a>
  </span>
  <span class="r">共有数据：<strong>{{count($brand)}}</strong> 条</span>
  </div>
  
  <!-- 提示框 -->
  @if (count($errors) > 0)
    <div class="Huialert Huialert-error">
        @foreach ($errors->all() as $error)
            <i class="Hui-iconfont">&#xe6a6;</i>品牌名称不能为空
        @endforeach
    </div>
  @endif

  @if(Session::has('success'))
  <div class="Huialert Huialert-success"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('success')}}</div>
  @elseif(Session::has('error'))
  <div class="Huialert Huialert-error"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('error')}}</div>
  @endif

    <table class="table table-border table-bordered table-bg table-sort">
      <thead>
        <tr class="text-c">
          <th width="70">ID</th>
          <th width="200">LOGO</th>
          <th width="120">品牌名称</th>
          <th width="100">操作</th>
        </tr>
      </thead>
      <tbody>
      @foreach($brand as $row)
        <tr class="text-c">
          <td>{{$row->brand_id}}</td>
          <td><img src="{{$row->brand_img}}" width="100"></td>
          <td class="text-c">{{$row->brand_name}}</td>
          <td class="f-14 product-brand-manage">
            <a title="编辑" href="javascript:void(0)" class="btn btn-primary radius edit"><i class="Hui-iconfont">&#xe6df;</i></a>
            <form action="product_brand/{{$row->brand_id}}" method="post" style="display: initial;">
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
      {{$brand->appends($request)->render()}}
      </div>
  </div>
</div>

<!-- 添加品牌窗口 -->
<div id="modal-demo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content radius">
      <div class="modal-header">
        <h3 class="modal-title">添加品牌</h3>
        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
      </div>
      <form action="product_brand" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          品牌名称: <input type="text" name="brand_name" class="input-text radius" style="width:80%"><br/><br/>
          品牌LOGO: <input type="file" name="pic">
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
<!-- 添加品牌窗口结束 -->

<!-- 编辑品牌窗口 -->
<div id="modal-demo-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content radius">
      <div class="modal-header">
        <h3 class="modal-title">编辑品牌</h3>
        <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
      </div>
      <form action="product_brand/1" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id">
        <div class="modal-body">
          品牌名称: <input type="text" name="brand_name" class="input-text radius edit_name" style="width:80%"><br/><br/>
          品牌LOGO: <input type="file" name="pic">
          <img class="img_logo" src="" width="100">
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
<!-- 编辑品牌窗口结束 -->

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
    //当前点击的图片地址
    img=$(this).parents("tr").find('td').eq(1).html();
    //当前点击的名称
    name=$(this).parents("tr").find('td').eq(2).html();
    

    $("input[name='id']").val(id);
    $('.edit_name').val(name);
    $(".img_logo").attr('src',img);
    $("#modal-demo-edit").modal("show")

  });
  

</script>

</body>
</html>
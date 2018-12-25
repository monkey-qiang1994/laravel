<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
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
<title>产品列表</title>
<link rel="stylesheet" href="/admin/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
</head>
<body class="pos-r">
<div>
  <nav class="breadcrumb">
  <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 评价列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
  <div class="page-container">

    <!-- 提示框 -->
    @if (count($errors) > 0)
      <div class="Huialert Huialert-error">
          @foreach ($errors->all() as $error)
              <i class="Hui-iconfont">&#xe6a6;</i>用户名不能为空
          @endforeach
      </div>
    @endif

    @if(Session::has('success'))
    <div class="Huialert Huialert-success"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('success')}}</div>
    @elseif(Session::has('error'))
    <div class="Huialert Huialert-error"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('error')}}</div>
    @endif
    <div class="mt-20">
      <table class="table table-border table-bordered table-bg table-hover table-sort">
        <thead>
          <tr class="text-c">
            <th width="40"><input name="" type="checkbox" value=""></th>
            <th width="40">产品ID</th>
            <th width="60">缩略图</th>
            <th width="200">产品名称</th>
            <th width="100">所属分类</th>
            <th width="60">价格</th>
            <th width="60">折扣价格</th>
            <th width="100">所属品牌</th>
            <th width="100">评价条数</th>
            <th width="100">查看评价</th> 
          </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
          <tr class="text-c va-m">
            <td><input name="" type="checkbox" value=""></td>
            <td>{{$v->product_id}}</td>
            <td><img width="60" class="product-thumb" src="{{$v->product_img}}"></td>
            <td class="text-l">{{$v->product_name}}</td>
            <td class="text-c">{{$v->cate_name}}</td>
            <td><span class="price">{{$v->price}}</span> 元</td>
            <td class="text-c">
              @if($v->discount_price)
                {{$v->discount_price}}
              @else
                无优惠
              @endif
            </td>
            <td class="text-c">{{$v->brand_name}}</td>
            <td class="text-c">
              @foreach($arr as $arr_k=>$arr_v)
              @if($arr_k == $v->product_id)
              <span class="label label-success radius"> {{$arr_v}}</span>
              @endif
              @endforeach
            </td>
            <td class="td-manage">
              <a href="javascript:;" style="text-decoration:none;font-size: 25px;" onclick="picture_add('订单详情','/adminx/evaluation?id={{$v->product_id}}')"><i class="Hui-iconfont">&#xe627;</i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    <div class="r">
      {{$data->appends($request)->render()}}
    </div>
    </div>
  </div>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
/*用户-查看*/
function member_show(title,url,id,w,h){
  layer_show(title,url,w,h);
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

</script>
</body>
</html>
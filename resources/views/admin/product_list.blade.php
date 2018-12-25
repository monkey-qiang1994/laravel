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
  <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
  <div class="page-container">
    <div class="text-r">
    <form action="product_list" method="get">
      <input type="text" name="keyword" placeholder="产品名称" style="width:250px" class="input-text">
      <button class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
    </form>
    </div>

    @if(Session::has('success'))
    <div class="Huialert Huialert-success"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('success')}}</div>
    @elseif(Session::has('error'))
    <div class="Huialert Huialert-error"><i class="Hui-iconfont">&#xe6a6;</i>{{Session::get('error')}}</div>
    @endif
    
    <div class="cl pd-5 bg-1 bk-gray mt-20">
      <span class="l">
        <a href="javascript:;" class="btn btn-danger radius" id="delete" onclick="return confirm('确定要删除?');"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
        <a class="btn btn-primary radius" href="product_list/create"><i class="Hui-iconfont">&#xe600;</i> 添加产品</a>
      </span>
    <span class="r">共有数据：<strong>{{count($total)}}</strong> 条</span>
    </div>
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
            <th width="100">产品状态</th>
            <th width="50">上下架</th>
            <th width="50">库存</th>
            <th width="100">操作</th>
          </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
          <tr class="text-c va-m">
            <td><input name="check" type="checkbox" value="{{$v->product_id}}"></td>
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
            <td class="text-c">{{$status[$v->status]}}</td>
            <td class="td-status">
               <form action="product_display" method="post">
                {{csrf_field()}}
                  <input type="hidden" name="id" value="{{$v->product_id}}"> 
                @if($v->display == 0)
                  <input type="hidden" name="display" value="1">
                  <button type="submit" class="btn btn-success radius btn-status">已发布</button>
                @else
                  <input type="hidden" name="display" value="0">
                  <button type="submit" class="btn btn-danger radius btn-status">已下架</button>
                @endif
               </form>
            </td>
            <td class="text-c">{{$v->stock}}</td>
            <td class="td-manage">
              <a title="编辑" href="product_list/{{$v->product_id}}/edit" class="btn btn-primary radius edit"><i class="Hui-iconfont">&#xe6df;</i></a>
              <form action="product_list/{{$v->product_id}}" method="post" style="display: initial;">
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

  a = new Array();

  $('#delete').click(function(){

    $('.table').find('.va-m').each(function(){
        //这里判断id是因为不判断的话,输入找到的内容是checked的,但是循环还在继续其他的内容会是undefined
        id = $(this).find('input:checkbox:checked').val();
        if(id){
          a.push(id);
        }
      });
    
    $.get('delall',{a:a},function(data){
      if(data == 1){
        $.Huimodalalert('商品已删除',1500);
        location.reload();
      }
    });

  });

</script>
</body>
</html>
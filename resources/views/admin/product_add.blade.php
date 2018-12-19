<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
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
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />

<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

</head>
<body>
<div class="page-container">
	@if (count($errors) > 0)
	<div class="Huialert Huialert-danger">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif

	<form action="/adminx/product_list" method="post" class="form form-horizontal" id="form-article-add" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" name="product_name" value="{{old('product_name')}}">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<span class="select-box">
					<select name="cate_id" class="select">
						@foreach($cate_list as $list)
						<option value="{{$list->cate_id}}" @if($list->cate_id == old('cate_id')) selected @endif >{{$list->cate_name}}</option>
						@endforeach
					</select>
				</span>
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">所属品牌：</label>
			<div class="formControls col-xs-8 col-sm-9">

			<span class="select-box">
				<select name="brand_id" class="select">
					@foreach($brand_list as $row)
					<option value="{{$row->brand_id}}" @if($row->brand_id == old('brand_id')) selected @endif >{{$row->brand_name}}</option>
					@endforeach()
				</select>
			</span>

			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-11" style="text-align: left;padding-left: 9.966666666666664%;">产品属性：</label>
			<!-- 循环属性分类数据 -->
			@foreach($cate_att as $cate_att_list)
			<div class="formControls col-xs-8 col-sm-9 skin-minimal" style="padding-left: 17.966666666666664%; top: -30px;">
			<h4>{{$cate_att_list->cate_att_name}}</h4>
			  <!-- 循环属性值数据 -->
			  @foreach($attributes as $value)
			  <!-- 判断当属性值的所属分类ID等于分类的ID时才遍历进去 -->
			  @if($value->cate_att_id == $cate_att_list->cate_att_id)
			  <div class="check-box">
			  	@if(old('att_id'))
			    <input type="checkbox" id="checkbox-2" name="att_id[]" value="{{$value->att_id}}" @if(in_array($value->att_id,old('att_id'))) checked @endif >
			    @else
			    <input type="checkbox" id="checkbox-2" name="att_id[]" value="{{$value->att_id}}">
			    @endif
			    <label>{{$value->att_name}}</label>
			  </div>
			  @endif
			  @endforeach
			</div>
			@endforeach
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品价格：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" name="price" class="input-text" value="{{old('price')}}" style="width:90%">
				元</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">优惠价格价格：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" name="discount_price" class="input-text" value="{{old('discount_price')}}" style="width:90%">
				元</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>库存：</label>
			<div class="formControls col-xs-8 col-sm-3">
				<input type="text" name="stock" value="{{old('stock')}}" class="input-text">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>产品图片：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="file" name="pics[]" multiple>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">产品状态：</label>
			<div class="formControls col-xs-8 col-sm-9">

			<span class="select-box">
				<select name="status" class="select">
					<option value="0">请选择状态</option>
					<option value="1" @if(old('status') == 1) selected @endif>爆款推荐</option>
					<option value="2" @if(old('status') == 2) selected @endif>新品直达</option>
					<option value="3" @if(old('status') == 3) selected @endif>畅销产品</option>
				</select>
			</span>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">详细内容：</label>
			<div class="formControls col-xs-8 col-sm-9"> 
				<script id="editor" type="text/plain" name="description" style="width:100%;height:200px;">{!! old('description') !!}</script> 
			</div>
		</div>
		{{csrf_field()}}
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加产品</button>
			</div>
		</div>
	</form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
$(function(){
	var ue = UE.getEditor('editor');
});

$(function(){
	$('input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	})});
</script>
</body>
</html>
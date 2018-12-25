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
<title>新增图片</title>
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page-container">
  <form class="form form-horizontal" id="form-article-add" method="post" action="/adminx/ads/{{$res->ads_id}}" enctype="multipart/form-data">
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片标题：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <input type="text" class="input-text" value="{{$res->ads_name}}" placeholder="" id="" name="ads_name">
      </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <span class="select-box">
        <select name="ads_position" class="select">
          <option disabled="disabled" >请选择添加位置</option>
          <option value="1" <?php echo $res->ads_position==1?'selected':''; ?>>轮播图</option>
          <option value="2" <?php echo $res->ads_position==2?'selected':''; ?>>位置2</option>
          <option value="3" <?php echo $res->ads_position==3?'selected':''; ?>>位置3</option>
          <option value="4" <?php echo $res->ads_position==4?'selected':''; ?>>位置4</option>
          <option value="5" <?php echo $res->ads_position==5?'selected':''; ?>>位置5</option>
        </select>
        </span>
      </div>
    </div>

      <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>图片状态：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <span class="select-box">
        <select name="ads_status" class="select" >
          <option disabled="disabled" >请选择状态</option>
          <option value="0" <?php echo $res->ads_status==0?'selected':''; ?>>启用</option>
          <option value="1" <?php echo $res->ads_status==1?'selected':''; ?>>停用</option>
        </select>
        </span>
      </div>
    </div>

    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">图片预览：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <div class="uploader-list-container"> 
            <img src="/uploads/slider/{{$res->ads_path}}" width="200">
        </div>
      </div>
    </div>

   <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">图片上传：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <div class="uploader-list-container"> 
          <div class="queueList">
            <div id="dndArea" class="placeholder">
              <div id="filePicker-2">
                  <input type="file" name="pic" >
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
        <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
      </div>
    </div>
  </form>
</div>

                @if(Session::has('error'))
                  <div class="error">{{Session::get('error')}}</div>
                  @endif


<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript">

  //提示信息
  var error = $('.error').html();
  function modaldemo(){
  $("#modal-demo").modal("show")}
      function modalalertdemo(){
      $.Huimodalalert(error,1000)}
  if (error) {
    modalalertdemo();
  }



</script>
</body>
</html>
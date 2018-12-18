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
<link rel="shortcut icon" href="/favicon.ico">
<link rel="stylesheet" href="/home/css/iconfont.css">
<link rel="stylesheet" href="/home/css/global.css">
<link rel="stylesheet" href="/home/css/bootstrap.min.css">
<link rel="stylesheet" href="/home/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/home/css/swiper.min.css">
<link rel="stylesheet" href="/home/css/styles.css">
<script src="/home/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
<script src="/home/js/bootstrap.min.js" charset="UTF-8"></script>
<script src="/home/js/swiper.min.js" charset="UTF-8"></script>
<script src="/home/js/global.js" charset="UTF-8"></script>
<script src="/home/js/jquery.DJMask.2.1.1.js" charset="UTF-8"></script>
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>新增图片</title>
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<body>
@foreach($res as $v)
      <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">优惠卷：</label>
      <div class="formControls col-xs-8 col-sm-9">
          <div class="tab-content"> 
     <div role="tabpanel" class="tab-pane fade in active" id="useful"> 
      <div class="coupon-list"> 
       <div class="coupon"> 
        <div class="coupon-hd"> 
         <b><small class="fz16">&yen;</small>{{$v->coupon_price}}</b> 
         <div class="fz12">
          【过期时间】
          <br />{{date('Y-m-d H:i:s',$v->coupon_time)}}
         </div> 
        </div> 
        <div class="coupon-bd"> 
         <div class="fz12 c9">
          券号：{{$v->coupon_num}}
         </div> 
         <div class="fz12 c9">规则： 消费需满{{$v->coupon_down}}元</div>

        </div> 
        <p class="coupon-ft">{{$v->coupon_caption}}</p> 
       </div> 
      </div>
     </div>
    </div>
      </div>
    </div>
    @endforeach
    @if(Session::has('error'))
    <div class="error">{{Session::get('error')}}</div>
    @endif
  <form class="form form-horizontal" id="form-article-add" method="post" action="/adminx/coupon_dosend?id={{$v->coupon_id}}" >
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>请选择发送对象：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <span class="select-box">
        <select name="coupon_status" class="select" id="aa">
          <option disabled="disabled" selected="selected">请选择发送对象</option>
          <option value="all" >全选</option>
          <option value="some" class="selected">部分用户用户</option>
        </select>
        </span>
      </div>
    </div>

    <div class="row cl user" style="display: none">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>发送对象：</label>
      <div class="formControls col-xs-8 col-sm-9">
        <!-- 选择部分用户 -->
      <div class="skin-minimal">
        <div class="check-box " >
          <input type="checkbox"  name="coupon_status1" value="1" >
          <label for="checkbox-1">用户名</label>
        </div>
        <div class="check-box " >
          <input type="checkbox"  name="coupon_status2" value="2" >
          <label for="checkbox-1">用户名</label>
        </div>
        <div class="check-box " >
          <input type="checkbox"  name="coupon_status3" value="3" >
          <label for="checkbox-1">用户名</label>
        </div>
      </div>
      <!-- 选择部分用户 -->
    </div>
  </div>

    <div class="row cl">
      <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
        {{csrf_field()}}
        <button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 发送</button>
        <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
      </div>
    </div>
  </form>
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

$(function(){
  $('.skin-minimal input').iCheck({
    checkboxClass: 'icheckbox-blue',
    radioClass: 'iradio-blue',
    increaseArea: '20%'
  })});

  //提示信息
  var error = $('.error').html();
  function modaldemo(){
  $("#modal-demo").modal("show")}
      function modalalertdemo(){
      $.Huimodalalert(error,1000)}
  if (error) {
    modalalertdemo();
  }

  $('#aa').change(function(){
    aa = $('#aa').val();
    if(aa=='some'){
      $('.user').css('display','block');
    }else{
      $('.user').css('display','none');
    }
  });

</script>
</body>
</html>
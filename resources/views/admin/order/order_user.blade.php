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
<title>用户查看</title>
</head>
<body>
  @if(!$pic->isEmpty())
  @foreach($pic as $pic_v)
<div class="cl pd-20" style=" background-color:#5bacb6">
  <img class="avatar size-XL l" src="{{$pic_v->pic}}">
  <dl style="margin-left:80px; color:#fff">
    <dt>
      <span class="f-18">{{$pic_v->username}}</span>
      <span class="pl-10 f-12"></span>
    </dt>
    <dd class="pt-10 f-12" style="margin-left:0">{{$pic_v->address}}</dd>
  </dl>
</div>
@endforeach
@else
@foreach($user as $user_v)
<div class="cl pd-20" style=" background-color:#5bacb6">
  <img class="avatar size-XL l" src="/admin/static/h-ui/images/ucnter/avatar-default.jpg">
  <dl style="margin-left:80px; color:#fff">
    <dt>
      <span class="f-18">{{$user_v->username}}</span>
      <span class="pl-10 f-12"></span>
    </dt>
    <dd class="pt-10 f-12" style="margin-left:0">暂无地址</dd>
  </dl>
</div>
@endforeach 
@endif
<div class="pd-20">
  @if(!$pic->isEmpty())
  @foreach($pic as $pic_vv)
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">性别：</th>
        @if($pic_vv->sex == 1)
        <td>男</td>
        @else
        <td>女</td>
        @endif
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td>{{$pic_vv->phone}}</td>
      </tr>
      <tr>
        <th class="text-r">邮箱：</th>
        <td>admin@mail.com</td>
      </tr>
      <tr>
        <th class="text-r">地址：</th>
        <td>{{$pic_vv->address}}</td>
      </tr>
      <tr>
        <th class="text-r">注册时间：</th>
        <td>{{Date('Y-m-d H:i:s',$pic_vv->created_at)}}</td>
      </tr>

    </tbody>
  </table>
  @endforeach
  @else
  @foreach($user as $user_vv)
  <table class="table">
    <tbody>
      <tr>
        <th class="text-r" width="80">性别：</th>
        <td>未定义</td>
  
      </tr>
      <tr>
        <th class="text-r">手机：</th>
        <td>{{$user_vv->phone}}</td>
      </tr>
      <tr>
        <th class="text-r">邮箱：</th>
        <td>admin@mail.com</td>
      </tr>
      <tr>
        <th class="text-r">注册时间：</th>
        <td>{{Date('Y-m-d H:i:s',$user_vv->created_at)}}</td>
      </tr>

    </tbody>
  </table>
  @endforeach
  @endif

</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> 
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
</body>
</html>
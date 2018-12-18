<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/static/js/html5.js"></script>
<script type="text/javascript" src="/admin/static/js/respond.min.js"></script>
<script type="text/javascript" src="/admin/static/js/pie_ie678.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/admin/static/css/h-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/css/h-ui.article.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/css/iconfont.css" />
<script type="text/javascript" src="/admin/static/js/jquery.min.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="/admin/static/js/dd_belatedpng_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('.pngfix,.icon,.list-icon');</script>
<![endif]-->
<title>[新闻标题]-[网站名称]新闻中心</title>
<meta name="keywords" content="[tags标签]">
<meta name="description" content="[新闻完整标题]。">
</head>
<body>
<div class="sideBox">
  <div class="sideTool cl">
    <a href="javascript:void(0);" class="iReadMode cl"><span class="inight"><i></i></span><span class="iday"><i></i></span></a>
  </div>
</div>
<div class="containBox">
	<div class="containBox_opbg" style="display:none"></div>
	<header class="header_top">
  <div class="Hui-wraper">
    <nav class="header-nav l"> <a href="/../cases/article/index.shtml" class="home l"><i></i>H-ui</a><a href="/../cases/article/list.shtml" class="l">资讯</a> </nav>
    <a href="#" class="h-download"><i></i>客户端</a> <i class="tmBtn"></i> </div>
</header>

	<div class="Hui-wraper cl pt-10">

		<div class="cl ct2">
			<section class="mn">
				<article class="article_show cl">
					@foreach($info as $v)
					<form action="/adminx/review" method="get">
						<div class="radio-box">
							<input type="hidden" name="id" value="{{$v->article_id}}">
						    <input type="radio" id="radio-1" name="article_status" value="1">
						    <label for="radio-1">通过审核</label>
					  </div>
					    <div class="radio-box">
						    <input type="radio" id="radio-1" name="article_status" value="-1">
						    <label for="radio-1">不通过</label>
					  </div>
					  <!-- {{csrf_field()}} -->
					  	<button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 提交审核</button>
					</form>
					<div class="titlebar">
						<h1>{{$v->article_title}}</h1>
						<div class="titbar cl"> <span>{{$v->article_created_at}}</span>  <span class="cishu">作者：{{$v->author}} </span> 
							
						</div>
					</div>
					<div id="cnt_main_article" class="content cl">
						{!!$v->article_content!!}
					</div>
				</article>
	


			</section>
			<aside class="sd">
      <section class="mb-10"><a href="#" target="_blank" rel="nofollow"><img src="/admin/static/picture/ad-300x250.gif" width="300" height="250"></a></section>
      @endforeach
      <section class="mb-10"><a href="#" target="_blank" rel="nofollow"><img src="/admin/static/picture/ad-300x250.gif" width="300" height="250"></a></section>
    </aside> 
		</div>
	</div>
	<footer class="footer">
  <p>Copyright &copy;2013-2016 H-ui.net All Rights Reserved. <br>
<a href="http://www.miitbeian.gov.cn/" target="_blank" rel="nofollow">京ICP备15015336号-1</a><br>
未经允许，禁止转载、抄袭、镜像<br>用心做站，做不一样的站</p>
</footer>
<script type="text/javascript" src="/admin/static/js/stickup.min.js"></script>
<script type="text/javascript" src="/admin/static/js/h-ui.js"></script>
<script type="text/javascript" src="/admin/static/js/article.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s)})();
</script> 
</div>
</body>
</html>
	<!-- 继承模版 -->
	@extends('home.layouts.public')

	<title>@yield('title','友情链接')</title>
	
	@section('css')
	<link rel="stylesheet" href="/home/css/iconfont.css">
	<link rel="stylesheet" href="/home/css/global.css">
	<link rel="stylesheet" href="/home/css/bootstrap.min.css">
	<link rel="stylesheet" href="/home/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="/home/css/login.css">
	<link rel="stylesheet" href="/home/css/swiper.min.css">
	<link rel="stylesheet" href="/home/css/styles.css">
	<script src="/home/js/jquery.1.12.4.min.js" charset="UTF-8"></script>
	<script src="/home/js/bootstrap.min.js" charset="UTF-8"></script>
	<script src="/home/js/swiper.min.js" charset="UTF-8"></script>
	<script src="/home/js/jquery.form.js" charset="UTF-8"></script>
	<script src="/home/js/global.js" charset="UTF-8"></script>
	<script src="/home/js/login.js" charset="UTF-8"></script>
	<script src="/home/js/jquery.DJMask.2.1.1.js" charset="UTF-8"></script>
	@endsection
	<style>
		@charset "gb2312";
		/* CSS Document */
		.Main{width:990px}
		.link_tit{height:30px;line-height:30px;background:#f7f7f7;padding-left:10px; font-family:\5fae\8f6f\96c5\9ed1;font-weight:normal;}
		/*.link_top,.link_bottom{ background: url(i/links_borders.jpg) repeat-x;line-height:0;font-size:0;overflow:hidden}
		.link_top{height:4px}
		.link_bottom{height:3px; background-position:0 -4px}*/
		.link_content{border:1px solid #ddd;overflow:hidden;zoom:1}
		.link_content a{color:#3265cb}
		.link_list{padding:10px 30px 0;}

		.link_list:after {
			content:".";
			display:block;
			height:0;
			clear:both;
			visibility:hidden;
		}
		.link_list{
			display:inline-table;
		}
		/* Hides from IE-mac \*/*html ..link_list {
			height:1%;
		}
		..link_list {
			display:block;
		}
		/* End hide from IE-mac */*+html ..link_list {
			min-height:1%;
		}

		.link_list li{padding-left:28px;float:left;width:157px;height:32px;line-height:32px;background:url(//misc.360buyimg.com/skin/201006/i/20130427A.png) no-repeat 8px 50%;border-bottom:1px dotted #ccc;white-space:nowrap;overflow:hidden;}
		.root61 .link_list li{width:201px;}
		.link_list li a{color:#005ea7;}
		.link_box_a{margin-top:10px;margin-bottom:10px;}
		/*.link_box_a .link_content{ background:url(i/links_16.gif) no-repeat 568px 0}*/
		.link_step{margin:10px 0 0 30px;float:left;width:500px;border-right:1px dotted #ccc;margin-right:43px;padding-bottom:170px;}
		.link_step li{margin-top:10px;width:476px;line-height:22px}
		.link_box_a .link_step_tit{font-weight:bold}
		.margin_l_12{margin-left:12px}
		.w247{width:245px;padding:6px 1px;;height:18px;line-height:18px; border:1px solid #ccc;height:18px;}
		.w247h60{width:245px;padding:1px; border:1px solid #ccc;height:120px;}

		.link_button{position:relative;left:-100px;background:url(//misc.360buyimg.com/skin/201006/i/20130427B.png) no-repeat;width:81px;height:25px;border:0;color:#fff;font-weight:bold; cursor:pointer;margin-bottom:20px;font-family:\5b8b\4f53;}

		.Paginationation{clear:both;margin-right:66px}
		.font_e30101{color:#e30101}
		.top_left,.top_right,.bottom_left,.bottom_right{display:none; background-image:url(i/links_border.jpg); background-repeat:no-repeat;width:10px}
		.top_left{height:4px}
		.top_right{float:right; background-position:-10px 0;height:4px}
		.bottom_left{ background-position:0 -4px;height:3px}
		.bottom_right{float:right;background-position:-10px -4px;height:3px}.rank .link_FF7403{color:#FF7403}
		.link_table{width:402px;margin-top:20px;}
		.link_table td{padding-top:10px;}
		label.error{margin-left:5px;color:#999;}
		.float_Left{float:left}

		.root61 .link_step{width:550px;}
		.Pagination{float:right;margin:0 30px 20px;}

		.Pagination a,.Pagination span {
			float:left;
			height:20px;
			padding:3px 10px;
			border:1px solid #ccc;
			margin-left:2px;
			font-family:arial;
			line-height:20px;
			font-size:14px;
			overflow:hidden;
			-moz-border-radius:5px;
			-webkit-border-radius:5px;
			border-radius:5px;
		}
		.Pagination .text,.Pagination .current {
			border:none;
			padding:4px 11px;
		}
		.Pagination a:link,.Pagination a:visited {
			color:#005aa0;
		}
		.Pagination a:hover,.Pagination a:active {
			background:#005aa0;
			color:#fff;
			text-decoration:none;
		}
		.Pagination .current,.Pagination .current:link,.Pagination .current:visited {
			color:#f60;
			font-weight:bold;
		}
		.Pagination b {
			dispaly:block;
			position:absolute;
			top:9px;
			width:5px;
			height:9px;
			background-image:url(//misc.360buyimg.com/201007/skin/df/i/bg_hotsale.gif);
			background-repeat:no-repeat;
			overflow:hidden;
		}
		.Pagination .prev,.Pagination .next,.Pagination .prev-disabled,.Pagination .next-disabled {
			position:relative;
			padding-top:5px;
			height:18px;
			line-height:18px;
		}
		.Pagination .prev-disabled,.Pagination .next-disabled {
			color:#ccc;
			cursor:default;
		}
		.Pagination .prev,.Pagination .prev-disabled {
			padding-left:12px;
		}
		.Pagination .prev b {
			left:3px;
			background-position:-68px -608px;
		}
		.Pagination .prev-disabled b {
			left:3px;
			background-position:-80px -608px;
		}
		.Pagination .next,.Pagination .next-disabled {
			padding-right:12px;
		}
		.Pagination .next b {
			right:3px;
			background-position:-62px -608px;
		}
		.Pagination .next-disabled b {
			right:3px;
			background-position:-74px -608px;
		}
		.Pagination-m a,.Pagination-m span {
			height:14px;
			line-height:14px;
			font-size:12px;
		}
		.Pagination-m b {
			top:5px;
		}
		.Pagination-m .prev,.Pagination-m .next,.Pagination-m .prev-disabled,.Pagination-m .next-disabled {
			padding-top:3px;
			height:14px;
			line-height:14px;
			*line-height:16px;
		}

	</style>
	@section('main')
		<div class="container">
			<div class="content inner">
				<div class="link_content">
					<h3 class="link_tit">友情链接</h3>
					<ul class="link_list">
						<li><a href="//union.jd.com" target="_blank">网络赚钱</a></li>
						<li><a href="//www.jd.hk/" target="_blank">海囤全球</a></li>
						<li><a href="//smartdev.jd.com/" target="_blank">小京鱼</a></li>
						<li><a href="//smart.jd.com/" target="_blank">京鱼座</a></li>
						<li><a href="//huishou.jd.com/home.html" target="_blank">以旧换新</a></li>
						<li><a href="//ves.jd.com/" target="_blank">京东自营供应商入驻</a></li>
						<li><a href="//xinfang.jd.com/" target="_blank">京东房产</a></li>
						<li><a href="//sale.jd.com/act/EZrAyw5YvCI.html" target="_blank">京东服务帮</a></li>
						<li><a href="//lamp.jd.com/" target="_blank">京东物流广告</a></li>
						<li><a href="https://www.cehome.com/" target="_blank">铁甲网</a></li>
						<li><a href="//ffs.jd.com/" target="_blank">京东飞服师</a></li>
						<li><a href="http://baike.leju.com/" target="_blank">房产百科</a></li>
						<li><a href="//ft.jd.com" target="_blank">企业金融服务</a></li>
						<li><a href="//yp.jd.com/" target="_blank">京东优评</a></li>
						<li><a href="http://www.wjw.cn/" target="_blank">全球五金网</a></li>
						<li><a href="http://www.etlong.com/" target="_blank">易龙商务网</a></li>
						<li><a href="https://www.china.cn/" target="_blank">中国供应商</a></li>
						<li><a href="http://www.metalnews.cn/" target="_blank">金属价格网</a></li>
						<li><a href="http://www.yohobuy.com" target="_blank">有货网</a></li>
						<li><a href="https://www.jfq.com/" target="_blank">聚富财经</a></li>
						<li><a href="http://www.xzhdyy.com/" target="_blank">熊掌号运营</a></li>
						<li><a href="http://www.wadongxi.com" target="_blank">比价网</a></li>
						<li><a href="//ar.jd.com/" target="_blank">天工AR开放平台</a></li>
						<li><a href="http://www.yuntask.com/" target="_blank">云客网</a></li>
						<li><a href="//zhaoshang.jd.com/" target="_blank">京东招商</a></li>
						<li><a href="http://www.yingfeihong.com/" target="_blank">3M隔热膜</a></li>
						<li><a href="http://www.goumin.com" target="_blank">狗民网</a></li>
						<li><a href="http://www.orgcc.com" target="_blank">文化艺术网</a></li>
						<li><a href="http://www.huim.com/" target="_blank">惠喵</a></li>
						<li><a href="http://www.aihuishou.com/" target="_blank">手机回收</a></li>
						<li><a href="http://job.cehui8.com/" target="_blank">测绘招聘</a></li>
						<li><a href="http://www.xianzhaiwang.cn/" target="_blank">鄂州新闻</a></li>
						<li><a href="http://www.haitaobang.cn" target="_blank">海淘帮</a></li>
						<li><a href="http://www.hao224.com/" target="_blank">团购导航</a></li>
						<li><a href="http://www.biancui.com/" target="_blank">砭石</a></li>
						<li><a href="http://www.alihuahua.com/" target="_blank">鲜花速递</a></li>
						<li><a href="https://www.eelly.com/" target="_blank">服装批发衣联网</a></li>
						<li><a href="http://www.gjw.com/" target="_blank">购酒网</a></li>
						<li><a href="http://www.boxz.com/" target="_blank">盒子比价网</a></li>
						<li><a href="http://www.moonbasa.com/" target="_blank">梦芭莎</a></li>
						<li><a href="http://www.s.cn/list/lining" target="_blank">李宁</a></li>
						<li><a href="http://bj.offcn.com/" target="_blank">北京公务员考试网</a></li>
						<li><a href="http://www.sooshong.com/" target="_blank">首商网</a></li>
						<li><a href="http://www.cntrades.com/" target="_blank">中国贸易网</a></li>
						<li><a href="http://www.chinawj.com.cn/" target="_blank">五金商机网</a></li>
						<li><a href="http://www.job001.cn/" target="_blank">中山人才网</a></li>
						<li><a href="http://www.hrm.cn/" target="_blank">重庆人才网</a></li>
						<li><a href="http://www.xinjiadiy.com" target="_blank">新家优装</a></li>
						<li><a href="http://www.shanmai.cn/" target="_blank">山脉户外</a></li>
						<li><a href="http://www.51bi.com/" target="_blank">比购网</a></li>
						<li><a href="http://www.spider.com.cn/" target="_blank">蜘蛛网</a></li>
						<li><a href="https://www.smzdm.com/" target="_blank">什么值得买</a></li>
						<li><a href="http://www.youjuke.com/" target="_blank">上海装修</a></li>
						<li><a href="http://www.dongzao.com" target="_blank">冬枣网</a></li>
						<li><a href="http://wx.jcloud.com/" target="_blank">京东万象</a></li>
						<li><a href="http://www.renrzx.com/" target="_blank">人人装修网</a></li>
						<li><a href="http://www.51yyjj.com" target="_blank">办公家具</a></li>
						<li><a href="https://www.huacaozhijia.com/" target="_blank">花草之家</a></li>
						<li><a href="http://www.5i591.com/" target="_blank">鲜花速递</a></li>
						<li><a href="http://www.shushi100.com/" target="_blank">舒适100</a></li>
						<li><a href="http://www.youjiao5.com" target="_blank">幼教网</a></li>
						<li><a href="http://www.lanzhixin.cn/" target="_blank">网上订花</a></li>
						<li><a href="http://www.jcloud.com/" target="_blank">京东云</a></li>
						<li><a href="//luopan.jd.com" target="_blank">京东数据罗盘</a></li>
						<li><a href="http://www.wbh58.com/" target="_blank">万宝红红木家具</a></li>
						<li><a href="//smarthome.jd.com/" target="_blank">京东智能云</a></li>
						<li><a href="http://www.jdwl.com/" target="_blank">京东物流</a></li>
						<li><a href="//yao.jd.com" target="_blank">京东医药城</a></li>
						<li><a href="http://www.tuimei.com/" target="_blank">推媒网</a></li>
						<li><a href="http://www.91zxw.com" target="_blank">91装修网</a></li>
						<li><a href="http://fujian.jiutea.com/" target="_blank">福建茶叶网</a></li>
					</ul>
				</div>
			</div>	

			<div class="link_content">
				<h3 class="link_tit">申请友情链接</h3>
				<ul class="link_step">
					<li class="link_step_tit">申请步骤：</li>
					<li>
						<div class="float_Left">
							1.</div>
						<div class="margin_l_12">
							请先在贵网站做好京东的文字友情链接：
							<br> 链接文字：京东链接地址：
							<a href="//www.jd.com" target="_blank">www.jd.com</a></div>
					</li>
					<li>2.做好链接后，请在右侧填写申请信息。京东只接受申请文字友情链接。</li>
					<li>
						<div class="float_Left"> 3.</div>
						<div class="margin_l_12">
							已经开通我站友情链接且内容健康，符合本站友情链接要求的网站，经京东管理员审核后，可以显示在此友情链接页面。</div>
					</li>
					<li>
						<div class="float_Left"> 4.</div>
						<div class="margin_l_12">
							请通过右侧提交申请，注明：友情链接申请。</div>
					</li>
				</ul>
				<form id="frm_submit">
				<table cellpadding="0" cellspacing="0" class="link_table" width="309">
					<tbody><tr>
						<td height="29" colspan="2" valign="top" class="link_step_tit">
							申请信息</td>
					</tr>
					<tr>
						<td height="29">
							网站名称：
						</td>
						<td height="29">
							<input id="name" name="name" type="text" class="w247">
						</td>
					</tr>
					<tr>
						<td height="29">
							网&nbsp;&nbsp;&nbsp;&nbsp;址：
						</td>
						<td height="29">
							<input id="url" name="url" type="text" class="w247" value="http://">
						</td>
					</tr>
					<tr>
						<td height="35">
							电子邮箱：
						</td>
						<td height="29">
							<input id="email" name="email" type="text" class="w247">
						</td>
					</tr>
					<tr>
						<td width="61" height="29" valign="top">
							网站介绍：
						</td>
						<td width="348" valign="top">
							<textarea id="intro" name="intro" cols="" rows="" class="w247h60"></textarea>
						</td>
					</tr>
					<tr>
						<td height="45" colspan="2" align="center" valign="middle">
							<input type="button" value="提交申请" id="btnSubmit" class="link_button">
						</td>
					</tr>
				</tbody></table>
				</form>
			</div>

        </div>
	@endsection
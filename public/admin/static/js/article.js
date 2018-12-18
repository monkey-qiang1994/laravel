/* -----------H-ui前端框架-------------
* H-ui.article.js v1.0
* http://www.h-ui.net/
* Created & Modified by guojunhui
* Date modified 2015.08.19
*
* Copyright 2013-2015 北京颖杰联创科技有限公司 All rights reserved.
* Licensed under MIT license.
* http://opensource.org/licenses/MIT
*
*/
$(function(){
	/*左右滑动菜单*/
	var _addHeight = $(".containBox").height();
	$(".containBox_opbg,.sideBox").height(_addHeight);
	$(".tmBtn").click(function(){
		$(".containBox").css({"transform": "translate(-270px, 0px)"});
		$(".containBox_opbg").show();
	});
	$(".containBox_opbg").click(function(){
		$(".containBox").css({"transform": "translate(0px, 0px)"});
		$(this).hide();
	});
	$(".sideBox").click(function(){
		$(".containBox").css({"transform": "translate(0px, 0px)"});
		$(".containBox_opbg").hide();
	});
	/*阅读模式*/
	$(".iReadMode").click(function(){
		if($(this).hasClass('selected')){
			$(this).removeClass('selected');
			$("body").removeClass("night"); 
			return false;
		}
		else{
			$(this).addClass('selected');
			$("body").addClass("night");
			
			return false;
		}
		return false;
	});
	/*资讯详情页 字号变化*/
	$("#fontbig").click(function(){$("#fontSmall").css("color","#0B3B8C");$(this).css("color","#666");$("#cnt_main_article").css("font-size","18px");});
	$("#fontSmall").click(function(){$("#fontbig").css("color","#0B3B8C");$(this).css("color","#666");$("#cnt_main_article").css("font-size","14px");});

	/*返回顶部调用*/
	$(window).on("scroll",$backToTopFun);
	$backToTopFun();
});
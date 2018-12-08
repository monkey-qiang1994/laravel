<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="../admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="../admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="../admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="../admin/static/h-ui.admin/css/style.css" />
<script type="text/javascript" src="../admin/static/echarts.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="../admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>我的桌面</title>
</head>
<body>
<div class="page-container">
	<p class="f-20 text-success">欢迎使用H-ui.admin <span class="f-14">v3.1</span>后台模版！</p>
	<p>登录次数：18 </p>
	<p>上次登录IP：222.35.131.79.1  上次登录时间：2014-6-14 11:19:55</p>
	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th colspan="7" scope="col">信息统计</th>
			</tr>
			<tr class="text-c">
				<th>统计</th>
				<th>资讯库</th>
				<th>图片库</th>
				<th>产品库</th>
				<th>用户</th>
				<th>管理员</th>
			</tr>
		</thead>
		<tbody>
			<tr class="text-c">
				<td>总数</td>
				<td>92</td>
				<td>9</td>
				<td>0</td>
				<td>8</td>
				<td>20</td>
			</tr>
			<tr class="text-c">
				<td>今日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>昨日</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本周</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
			<tr class="text-c">
				<td>本月</td>
				<td>2</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
			</tr>
		</tbody>
	</table>
	<div style="width: 100%;height:400px;position: relative;top: 15px">
		 <div id="container-second" style="height: 100%"></div>
	</div>
	<div style="width: 100%;position: relative;top: 15px">
		<div style="float: left;width: 50%;height: 400px">
        <div id="container-nth-first" style="height: 100%"></div>  

		</div>
		<div style="float: right;width: 50%;height: 400px">
      <div id="container" style="height: 100%"></div>

		</div>
	</div>
</div>

<script type="text/javascript" src="../admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="../admin/static/h-ui/js/H-ui.min.js"></script> 
<!--此乃百度统计代码，请自行删除-->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
       <script type="text/javascript">
          var dom = document.getElementById("container");
          var myChart = echarts.init(dom);
          var app = {};
          option = null;
          option = {
              title : {
                  text: '某站点用户访问来源',
                  subtext: '纯属虚构',
                  x:'center'
              },
              tooltip : {
                  trigger: 'item',
                  formatter: "{a} <br/>{b} : {c} ({d}%)"
              },
              legend: {
                  orient: 'vertical',
                  left: 'left',
                  data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
              },
              series : [
                  {
                      name: '访问来源',
                      type: 'pie',
                      radius : '55%',
                      center: ['50%', '60%'],
                      data:[
                          {value:335, name:'直接访问'},
                          {value:310, name:'邮件营销'},
                          {value:234, name:'联盟广告'},
                          {value:135, name:'视频广告'},
                          {value:1548, name:'搜索引擎'}
                      ],
                      itemStyle: {
                          emphasis: {
                              shadowBlur: 10,
                              shadowOffsetX: 0,
                              shadowColor: 'rgba(0, 0, 0, 0.5)'
                          }
                      }
                  }
              ]
          };
          ;
          if (option && typeof option === "object") {
              myChart.setOption(option, true);
          }
       </script>
              <script type="text/javascript">
          var dom = document.getElementById("container-nth-first");
          var myChart = echarts.init(dom);
          var app = {};
          option = null;
          option = {
              backgroundColor: 'white',

              title: {
                  text: 'Customized Pie',
                  left: 'center',
                  top: 20,
                  textStyle: {
                      color: '#ccc'
                  }
              },

              tooltip : {
                  trigger: 'item',
                  formatter: "{a} <br/>{b} : {c} ({d}%)"
              },

              visualMap: {
                  show: false,
                  min: 80,
                  max: 600,
                  inRange: {
                      colorLightness: [0, 1]
                  }
              },
              series : [
                  {
                      name:'访问来源',
                      type:'pie',
                      radius : '55%',
                      center: ['50%', '50%'],
                      data:[
                          {value:335, name:'直接访问'},
                          {value:310, name:'邮件营销'},
                          {value:274, name:'联盟广告'},
                          {value:235, name:'视频广告'},
                          {value:400, name:'搜索引擎'}
                      ].sort(function (a, b) { return a.value - b.value; }),
                      roseType: 'radius',
                      label: {
                          normal: {
                              textStyle: {
                                  color: 'rgba(0, 0, 0)'
                              }
                          }
                      },
                      labelLine: {
                          normal: {
                              lineStyle: {
                                  color: 'rgba(0,0,0)'
                              },
                              smooth: 0.2,
                              length: 10,
                              length2: 20
                          }
                      },
                      itemStyle: {
                          normal: {
                              color: '#c23531',
                              shadowBlur: 200,
                              shadowColor: 'rgba(0, 0, 0, 0.5)'
                          }
                      },

                      animationType: 'scale',
                      animationEasing: 'elasticOut',
                      animationDelay: function (idx) {
                          return Math.random() * 200;
                      }
                  }
              ]
          };;
          if (option && typeof option === "object") {
              myChart.setOption(option, true);
          }
       </script>      
              <script type="text/javascript">
          var dom = document.getElementById("container-second");
          var myChart = echarts.init(dom);
          var app = {};
          option = null;
          option = {
              xAxis: {
                  type: 'category',
                  data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
              },
              yAxis: {
                  type: 'value'
              },
              series: [{
                  data: [120, 200, 150, 80, 70, 110, 130],
                  type: 'bar'
              }]
          };
          ;
          if (option && typeof option === "object") {
              myChart.setOption(option, true);
          }
       </script>
<!--/此乃百度统计代码，请自行删除-->
</body>
</html>
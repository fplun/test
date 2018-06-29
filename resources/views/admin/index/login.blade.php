<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/layui.css" media="all">
	<link href="/layui/css/loginadmin.css" rel="stylesheet" type="text/css">	
	<!--必要样式-->
    <link href="/layui/css/demo.css" rel="stylesheet" type="text/css"> 
	<style>
		.login{position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);margin-top:0;}
		.copyright{position:fixed;bottom:60px;left:50%;transform:translate(-50%,0);}
	</style>
     <title>后台管理</title>
<link id="layuicss-layer" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"></head><body>
<div class="login_box">
      <!-- <div class="login_l_img"><img src="/layui/images/login-img.png"></div> -->
      <div class="login">
          <div class="login_logo"><a href="#"><img src="/layui/images/login_logo.png"></a></div>
          <div class="login_name">
               <p>后台管理系统</p>
          </div>
          <form class="layui-form" action="" method="post" id="loginform">
             <input class="layui-input" name="username" placeholder="用户名" lay-verify="required" type="text" autocomplete="off">
              <input name="password" type="password" id="password" class="layui-input" placeholder="密码" lay-verify="required">
			      	<div class="login_fields__password">
				      <input name="code" placeholder="验证码" maxlength="4" lay-verify="required" type="text" autocomplete="off">
				      <div class="validation" style="opacity: 1; right: -5px;top: -3px;">
			             <canvas class="J_codeimg" id="myCanvas" onclick="Code();">对不起，您的浏览器不支持canvas，请下载最新版浏览器!</canvas>
				      </div>
				    </div>
                <input value="登录" id="loginbtn" style="width:100%;" class="" lay-submit="" lay-filter="login" type="button">
          </form>
      </div>
      <div class="copyright">©2018 众易链俱乐部 All Rights Reserved.</div>
</div>
<div style="text-align:center;">
</div>
	<script type="text/javascript" src="/layui/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="/layui/layui-v2.2.5/layui/layui.js"></script>
	<script type="text/javascript" src="/layui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/layui/js/Treatment.js"></script>
    <script type="text/javascript" src="/layui/js/jquery.mockjax.js"></script>
	<script type="text/javascript">
		var canGetCookie = 0;//是否支持存储Cookie 0 不支持 1 支持
		var ajaxmockjax = 1;//是否启用虚拟Ajax的请求响 0 不启用  1 启用
		//默认账号密码
		
		var truelogin = "123456";
		var truepwd = "123456";
		
		var CodeVal = 0;
	    Code();
	    function Code() {
			if(canGetCookie == 1){
				createCode("AdminCode");
				var AdminCode = getCookieValue("AdminCode");
				showCheck(AdminCode);
			}else{
				showCheck(createCode(""));
			}
	    }
	    function showCheck(a) {
			CodeVal = a;
	        var c = document.getElementById("myCanvas");
	        var ctx = c.getContext("2d");
	        ctx.clearRect(0, 0, 1000, 1000);
	        ctx.font = "80px 'Hiragino Sans GB'";
	        ctx.fillStyle = "#E8DFE8";
	        ctx.fillText(a, 0, 100);
	    }
	    $(document).keypress(function (e) {
	        // 回车键事件  
	        if (e.which == 13) {
	            $('#loginbtn').click();
	        }
	    });
	    var fullscreen = function () {
	        elem = document.body;
	        if (elem.webkitRequestFullScreen) {
	            elem.webkitRequestFullScreen();
	        } else if (elem.mozRequestFullScreen) {
	            elem.mozRequestFullScreen();
	        } else if (elem.requestFullScreen) {
	            elem.requestFullscreen();
	        } else {
	            //浏览器不支持全屏API或已被禁用  
	        }
	    }  

		

    </script>
    <script type="text/javascript" src="/layui/js/login.js?=1"></script>

</body></html>
<!DOCTYPE html>
<html lang="en">
	<head>
        <meta content="IE=11.0000" http-equiv="X-UA-Compatible" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>{{ __('密码找回') }}-{{ __('手机') }}</title>
		<link href="/user/css/bootstrap.css" rel="stylesheet"/>
		<link href="/user/css/iosoverlay.css" rel="stylesheet"/>
		<link href="/user/css/simple-line-icons.css" rel="stylesheet"/>
		<link href="/user/css/login.css" rel="stylesheet">
		<link href="/user/css/engine.css" rel="stylesheet" />
		<link href="/user/css/font-awesome.min.css" rel="stylesheet">
		<link href="/user/layui/css/layui.css" rel="stylesheet" media="all">
		<style type="text/css">
			.form-group {
				background: #fff;
				height: 40px;
				line-height: 40px;
				padding-left: 20px;
				border-radius: 5px;
			}
			
			.fa {
				font-size: 16px;
			}
			
			.form-control {
				color: #333 !important;
				display: inline-block;
				width: 80%;
				height: 40px;
				line-height: 40px;
				background: #fff;
				outline: none!important;
			}
		</style>
	</head>

	<body class="login">
		<div class="container">
			<form action="" method="POST">
			<div class="form-login" style="position:relative;z-index:5;margin-top:135px;">
				<div class="row">
					<div class="col-md-6 col-md-offset-6" style="padding-left:0px;padding-right:0px;border-radius:3px;">
						<div class="headwm">
							{{-- <img class="logowm" src="/user/images/logo.png" alt=""> --}}
							<div class="contri">
								<a href="/?_locale=zh_CN"><img src="/user/images/china.jpg" alt=""></a>
								<a href="/?_locale=en_US"><img src="/user/images/USA.jpg" alt=""></a>
								<a href="/?_locale=ko_KR"><img src="/user/images/korean.jpg" alt=""></a>
								<a href="/?_locale=ja_JP"><img src="/user/images/japan.jpg" alt=""></a>
							</div>
						</div>
						<div class="account-box">
							<form method="post"  class="layui-form"  action="" id="loginform" role="form">
								<div class="form-group">
									<i class="fa fa-user" aria-hidden="true"></i>
									<input name="huiNumber" type="text" id="login" lay-verify="huiNumber" class="form-control" placeholder="{{ __('请输入会员编号') }}" />
								</div>
								<div class="form-group">
									<i class="fa fa-user" aria-hidden="true"></i>
									<input name="huiPhone" type="text" id="login" lay-verify="huiEmail" class="form-control" placeholder="{{ __('请输入您的邮箱') }}" />
								</div>
								<div class="form-group">
									<table cellpadding="0" cellspacing="0" style="width:100%;">
										<tr>
											<td style="width:60%;">
												<input name="code" type="text" id="" lay-verify="required" class="form-control" placeholder="{{ __('邮箱验证码') }}" />
											</td>
											<td >
												<!-- <img id="checkimg" src="images/yzm.jpg" style="cursor:pointer;margin-right:2px;border-radius:3px;width:97%;height:38px;display:block;float:right;" /> -->
												 <div class='validation' style="opacity: 1; right: 31px;top: 8px;">
									                  <input type="button" id="btn"   class="btn btn-primary btn-block" 
									                   style="border: 0;right: -3px;top: 7px;cursor: pointer;width: 200px;"
									                   value="{{ __('发送邮箱验证码') }}" 
									                   onclick="settime(this);sendcode();" /> 
											      </div>
											</td>
										</tr>
									</table>
								</div>
									<div class="other-login" style="text-align:left;color: #fff;">
									<i></i>
										<a href="javascript:window.history.go(-1)"  style="color: #fff;">{{ __('返回') }}</a>
								</div>
								<div class='success' style="color:#fff;"></div>
								<input type="submit"   name="Button1"  lay-submit="" lay-filter="login" 
								 id="loginbtn"  
								 value="{{ __('找回密码') }}" class="btn btn-primary btn-block" style="margin-top:1em;" />
							</form>

							<div class="row-block">
								<div class="row" style="text-align:center;margin-top:2em;cursor:pointer;letter-spacing:0.8px;">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
    <script type="text/javascript" src="/user/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="/user/layui/layui.js"></script>
	<script type="text/javascript">
	    $(document).keypress(function (e) {
	        // 回车键事件  
	        if (e.which == 13) {
	        	  $('#loginform').click();
	        }
	    });
		layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element', 'layedit'], function(){
			var $ = layui.jquery
					, layer = layui.layer //独立版的layer无需执行这一句
					,form = layui.form
					,table = layui.table//数据表格
			,element = layui.element
			,layedit = layui.layedit
			 ,upload = layui.upload;
			
	    	//监听提交
	    	form.on('submit(login)', function(data){
	    		vali();
	    		return false;
	    	});
	    	
			//自定义验证规则  
			  form.verify({  
				 huiNumber: [/^[A-Za-z0-9]+$/, '会员编号只能输入字母或数字！']
			     ,huiTjrNum: [/^[A-Za-z0-9]+$/, '推荐人编号只能输入字母或数字！']
			     ,huiJdrNum: [/^[A-Za-z0-9]+$/, '接点人编号只能输入字母或数字！']
			     ,huiPhone: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！']   
			  ,huiEmail: [/[a-zA-Z0-9]{1,10}@[a-zA-Z0-9]{1,5}\.[a-zA-Z0-9]{1,5}/, '邮箱格式不正确！']   
			  });  
				var i = 1;
				var intervalid;
				window.fun = function(to) {
					if (i == 0) {
						window.location.href = to;
						clearInterval(intervalid);
					}
					document.getElementById("mes").innerHTML = i;
					i--;
				}
	    	window.vali = function(){
	    		$.ajax({
        			type: "POST",
        			dataType: "json",
        			async:false,
        			url: "/toemailpwd",
        			data: $("form").serialize(),
        			success: function (obj) {
        				 if(obj.Status=='ok'){
        					   $('.success').html('<p>操作成功，将在 <span id="mes">1</span> 秒钟后跳转密码找回页修改密码！</p>');
								intervalid =setInterval(function()
								{
									fun("/resetPassword");
								}, 1000); 
        				 }else{
        					 layer.msg(obj.Erro);
        					 return false;
        				 }
        			},
        			error: function(data) {
        				alert("网络错误");
        			}
        		});
	    	}
	    });
    </script>
    <script type="text/javascript"> 
		var countdown=60; 
		function settime(obj) { 
			  var login = $('input[name="huiPhone"]').val();
			  if(ismail(login)){
				  if (countdown == 0) { 
				        obj.removeAttribute("disabled");    
				        obj.value="免费获取验证码"; 
				        countdown = 60; 
				        return;
				    } else { 
				        obj.setAttribute("disabled", true); 
				        obj.value="重新发送(" + countdown + ")"; 
				        countdown--; 
				    } 
				setTimeout(function() { 
				    settime(obj) }
				    ,1000) 
			  }else{
				 alert("请输入正确的邮箱");
			  }
		    
		}
		function sendcode(){
			 var login = $('input[name="huiPhone"]').val();
			  if(ismail(login)){
				  $.ajax({
	        			type: "POST",
	        			dataType: "json",
	        			async:false,
	        			url: "/sendEmail",
	        			data: {
							  email:login,
							  username: $('input[name="huiNumber"]').val(),
	                     },
	        			success: function (obj) {
	        				 if(obj.Status=='ok'){
	        					  alert("发送成功,请注意查收");
	        				 }else{
	        					 alert("发送失败："+obj.Erro);
	        					 return false;
	        				 }
	        			},
	        			error: function(data) {
	        				alert("网络错误");
	        			}
	        		});
			  }else{
				  alert("请输入正确的邮箱");
			  }
		}
		//验证邮件格式
		function ismail(obj){
			var reg=/[a-zA-Z0-9]{1,10}@[a-zA-Z0-9]{1,5}\.[a-zA-Z0-9]{1,5}/;
			if(!reg.test(obj)){
				return false;
			}
			return true;
		}
		function isPoneAvailable(str) {
			var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
			if (!myreg.test(str)) {
				return false;
			} else {
				return true;
			}
		}
    </script>
	</body>

</html>
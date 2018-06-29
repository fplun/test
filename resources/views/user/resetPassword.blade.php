

<!DOCTYPE html>
<html lang="en">

	<head>
		<meta content="IE=11.0000" http-equiv="X-UA-Compatible" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>
			找回密码
		</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
		<link href="/user/css/bootstrap.css" rel="stylesheet" />
		<link href="/user/css/iosoverlay.css" rel="stylesheet" />
		<link href="/user/css/simple-line-icons.css" rel="stylesheet" />
		<link rel="stylesheet" href="/user/css/login.css">
		<link href="/user/css/engine.css" rel="stylesheet" />
		<link rel="stylesheet" href="/user/css/font-awesome.min.css">
	    <link rel="stylesheet" href="./user/layui/css/layui.css" media="all">
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
			<div class="form-login" style="position:relative;z-index:5;margin-top:135px;">
				<div class="col-md-6 col-md-offset-6" style="padding-left:0px;padding-right:0px;border-radius:3px;">
					<div class="account-box" style="padding-bottom: 52px;">
						<form class="layui-form"  method="post" action="" id="loginform"  role="form">
							<div class="form-group">
								<i class="fa fa-user" aria-hidden="true"></i>
								<input name="username"  type="text" value="{{ $user->username }}" readonly="readonly" lay-verify="required" class="form-control" placeholder="{{ __('请输入会员编号') }}" />
							</div>
							<!-- <div class="form-group">
								<i class="fa fa-user" aria-hidden="true"></i>
								<input name="phone"  type="text" value="{{ $user->phone }}" readonly="readonly" lay-verify="required" class="form-control" placeholder="{{ __('请输入您的手机号') }}" />
							</div> -->
						<!-- 	<div class="form-group">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
								<input name="old"  type="password" id="old"  lay-verify="required" class="form-control" placeholder="{{ __('旧密码') }}" />
							</div> -->
							<div class="form-group">
								<i class="fa fa-lock" aria-hidden="true"></i>
								<input  name="password"  type="password" id="newpwd" lay-verify="required" class="form-control" placeholder="{{ __('确认密码') }}" />
							</div>
								<div class="form-group">
								<i class="fa fa-lock" aria-hidden="true"></i>
								<input  name="password_confirmation"  type="password" id="newagin" lay-verify="required" class="form-control" placeholder="{{ __('再次确认密码') }}" />
							</div>
							<div class="other-login" style="text-align:left;color: #fff;">
								<a href="/" style="color:#fff;">{{ __('返回首页') }} Go</a>
							</div>
							<input type="button"   lay-filter="login"  lay-submit=""  name="Button1" value="{{ __('确认修改') }}" id="loginbtn" class="btn btn-primary btn-block" style="margin-top:1em;" />
						</form>
					</div>
				</div>

			</div>
		</div>
    <script type="text/javascript" src="/user/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="/user/layui/layui.js"></script>
    <script type="text/javascript" src="/user/js/Treatment.js"></script>
	<script type="text/javascript">
		var canGetCookie = 0;//是否支持存储Cookie 0 不支持 1 支持
		var ajaxmockjax = 1;//是否启用虚拟Ajax的请求响 0 不启用  1 启用
		//默认账号密码
		
		var truelogin = "123456";
		var truepwd = "123456";
		var CodeVal = 0;
	    $(document).keypress(function (e) {
	        // 回车键事件  
	        if (e.which == 13) {
	            $('#loginbtn').click();
	        }
	    });
	    layui.use('form', function(){
	    	var form = layui.form;

	    	//监听提交
	    	form.on('submit(login)', function(data){
	    		valiqt();
	    		return false;
	    	});
	    	
	    	window.valiqt = function(){
	    		$.ajax({
        			type: "POST",
        			dataType: "json",
        			async:false,
        			url: "/resetPassword",
        			data: $("#loginform").serialize(),
        			success: function (obj) {
        				 if(obj.Status=='ok'){
        					 layer.msg("修改成功,跳转登录页进行登录！");
        					 setTimeout(function(){
        						 location.href='/';
        					 },2000);
        				 }else{
        					 layer.msg(obj.msg);
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
	</body>

</html>
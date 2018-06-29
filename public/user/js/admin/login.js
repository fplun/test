layui.use('form', function(){
	var form = layui.form;

	//监听提交
	form.on('submit(login)', function(data){
			$.ajax({
				type: "POST",
				dataType: "json",
				async:false,
				url: "/admin/lvalidate",
				data: $("#loginform").serialize(),
				success: function (obj) {
					 if(obj.Status=='ok'){
						 layer.msg("登录成功");
						 if(obj.isnotice==0){
							 location.href='/admin/noticeuser';
						 }else if(obj.isnotice==2){
							 location.href='/admin/xiecmsg';
						 }else{
							 $("#loginform").submit();	 
						 }
					 }else{
						 layer.msg("账号和密码错误");
						 return false;
					 }
				},
				error: function(data) {
					alert("网络错误");
				}
			});
		return false;
	});
});

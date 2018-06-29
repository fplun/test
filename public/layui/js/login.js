layui.use('form', function(){
	var form = layui.form;

	//监听提交
	form.on('submit(login)', function(data){

		var code = $('input[name="code"]').val();
		if (code == '' || code.length != 4) {
			layer.msg('输入验证码');
			return ;
		}
		if (code.toUpperCase() != CodeVal.toUpperCase()) {
			layer.msg('验证码错误');
			return ;
		}
			
			$.ajax({
				type: "POST",
				dataType: "json",
				async:false,
				url: "/admin/login_make",
				data: $("#loginform").serialize(),
				success: function (obj) {
					 if(obj.Status=='ok'){
						location.href='/admin/index';
					 }else{
						 layer.msg(obj.Erro);
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

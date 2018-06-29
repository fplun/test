<!DOCTYPE html>
<html><head>
  <meta charset="utf-8">
  <title>消息中心</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
<link id="layuicss-layer" rel="stylesheet" href="/layui//layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
<script src="/layui/js/jquery-1.10.2.min.js"></script>
<script src="/layui/layui-v2.2.5/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript" src="/layui/js/settimeqt.js"></script></head>
<body layadmin-themealias="green">
   <div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
		  <div class="layui-field-box"> 
						 <form class="layui-form layui-form-pane" id="rpwdform" action="#" >
							<div class="layui-form-item">
								<label class="layui-form-label">公告标题</label>
								<div class="layui-input-inline">
									<input type="text" name="title" placeholder="请输入标题" lay-verify="title" autocomplete="off" class="layui-input">
								</div>
							</div>
							<div class="layui-form-item layui-form-text">
								<label class="layui-form-label">新闻内容</label>
								<div class="layui-input-block">
								     <input type="hidden" id="content" name="content"/>
									<textarea placeholder="请输入内容" name="content"  lay-verify="content" class="layui-textarea" id="demo" style="display: none;"></textarea>
								</div>
							</div>
							<div class="layui-form-item">
								<button class="layui-btn" lay-submit="" lay-filter="demo2">提交</button>
							</div>
						</form>              
		  </div>
        </div>
  </div>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
	layui.use(['form', 'layedit', 'laydate'], function(){
		var form = layui.form
				,layer = layui.layer
				,layedit = layui.layedit
				,laydate = layui.laydate;
		  var index = layedit.build('demo', {
				 uploadImage: {
				    url: '/admin/upload' //接口url
				    ,type: 'JSON' //默认post
				  }
				});
		//自定义验证规则
		form.verify({
			title: function(value){
				if(value.length < 2){
					return '标题至少得2个字符啊';
				}
			},
			content: function(value){
				 return layedit.sync(index);
			}
		});
		//监听提交
		form.on('submit(demo2)', function(data){
			var content = layedit.getContent(index);
			var content = layedit.getContent(index);
			$("#content").val(content);
			$.ajax({
				type: "POST",
				dataType: "json",
				async:false,
				url: "/admin/news_add",
				data: $("#rpwdform").serialize(),
				success: function (obj) {
					if(obj.Status=='ok'){
						layer.msg("添加公告成功");
						var index = parent.layer.getFrameIndex(window.name);
						setTimeout(function(){
							parent.layer.close(index);
							parent.closeadd();
						}, 1000);
					}else{
						layer.msg(obj.Erro);
						return false;
					}
				},
				error: function(data) {
					alert("请login的账号已失效，请重新login");
					parent.lout();
				}
			});
			return false;
		});
	});
</script>
</body></html>
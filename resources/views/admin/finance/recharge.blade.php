<html><head>
  <meta charset="utf-8">
  <title>会员注册</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
      <script src="/layui/js/jquery-1.10.2.min.js"></script>
	<script src="/layui/layui-v2.2.5/layui/layui.js"></script>
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
<script type="text/javascript" src="/layui/js/settimeqt.js"></script>
<link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
<body layadmin-themealias="green">
  <div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
				    <div class="layui-field-box">
						               <form class="layui-form layui-form-pane" action="">
						                  <div class="layui-field-box">
																							<input type="hidden" value="{{$type}}" name="type">
																							<input type="hidden" value="{{$id}}" name="id">
															                <div class="layui-form-item">
																			    <label class="layui-form-label">充值金额</label>
																			    <div class="layui-input-block">
																			      <input type="text" name="money" autocomplete="off" lay-verify="required" placeholder="请输入充值金额" class="layui-input">
																			    </div>
																			  </div>
													  </div>
														  <div class="layui-form-item">
														    <button class="layui-btn" lay-submit="" lay-filter="huiregsubmit">确认充值</button>
														  </div>
														</form>
				  </div>
        </div>
      </div>

	<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
	<script>
		layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element', 'layedit'], function(){
			var $ = layui.jquery
					, layer = layui.layer //独立版的layer无需执行这一句
					,form = layui.form
					,table = layui.table//数据表格
			,element = layui.element
			,layedit = layui.layedit
			 ,upload = layui.upload;
			 //监听提交(发送消息)
			  form.on('submit(huiregsubmit)', function(data){
				/*             layer.alert(JSON.stringify(data.field), {
	               title: '最终的提交信息'
	        })    */
				   //对话框
	  			   	  layer.confirm('您确定要充值吗？', function(index){
	  			   		 //发送请求  admin 指向后台 sendmsg 后台方法
	  			          $.post('/admin/recharge_make',
	  			   	    		data.field,//这个是表单序列化值
	  			   	    		function(obj){
	  			   	    	          if(obj.Status=='ok'){
	  			   	    	        	layer.msg('充值成功');
	  			   	    	        	parent.closeadd();
	  			   	    	          }else{
	  			   	    	        	layer.msg(obj.Erro);//该市场位置上已经有人，请重新选择市场位置！
	  			   	    	          }
	  		            	});	 
	  				 });  
			    return false;
			  });		 
		});
	</script>
</body></html>
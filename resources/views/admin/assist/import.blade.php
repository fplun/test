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
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"><script type="text/javascript" src="/layui/js/settimeqt.js"></script><link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
<body layadmin-themealias="green" style="">
  <div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
				    <div class="layui-field-box">
						         <form class="layui-form layui-form-pane" action="">
						                  <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
  <legend>数据导入</legend>
</fieldset> 
 
									<div class="layui-upload-drag" id="test0">
									  <i class="layui-icon"></i>
									  <p>上传拨出率</p>
									</div><input class="layui-upload-file" type="file" name="file">
						                  
						                  <div class="layui-upload-drag" id="test1">
									  <i class="layui-icon"></i>
									  <p>上传财务管理收货明细</p>
									</div><input class="layui-upload-file" type="file" name="file">
									<div class="layui-upload-drag" id="test2">
									  <i class="layui-icon"></i>
									  <p>上传管理员登录日志</p>
									</div><input class="layui-upload-file" type="file" name="file">
									<div class="layui-upload-drag" id="test3">
									  <i class="layui-icon"></i>
									  <p>上传会员充值记录</p>
									</div><input class="layui-upload-file" type="file" name="file">
									<div class="layui-upload-drag" id="test4">
									  <i class="layui-icon"></i>
									  <p>上传会员登录日志</p>
									</div><input class="layui-upload-file" type="file" name="file">
									<div class="layui-upload-drag" id="test5">
									  <i class="layui-icon"></i>
									  <p>上传会员提款记录</p>
									</div><input class="layui-upload-file" type="file" name="file">
									<div class="layui-upload-drag" id="test6">
									  <i class="layui-icon"></i>
									  <p>上传会员信息</p>
									</div><input class="layui-upload-file" type="file" name="file">
										<div class="layui-upload-drag" id="test7">
									  <i class="layui-icon"></i>
									  <p>上传套餐记录</p>
									</div><input class="layui-upload-file" type="file" name="file">
									
										<div class="layui-upload-drag" id="test8">
									  <i class="layui-icon"></i>
									  <p>账户明细</p>
									</div><input class="layui-upload-file" type="file" name="file">
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
			
			
			  //拖拽上传
			  upload.render({
			    elem: '#test0'
			    ,url: '/admin/import0'
		        ,exts: 'xlsx|xls' //只允许上传压缩文件
			    ,done: function(res){
			       if(res.errorNo=='0'){
			    	   layer.msg("导入成功");
			       }else{
			    	   layer.msg("导入失败");
			       }
			    }
			  });
			 
			  //拖拽上传
			  upload.render({
			    elem: '#test1'
			    ,url: '/admin/import1'
			    	,exts: 'xlsx|xls' //只允许上传压缩文件
			    ,done: function(res){
			    	if(res.errorNo=='0'){
				    	   layer.msg("导入成功");
				       }else{
				    	   layer.msg(res.errorInfo);
				       }
			    }
			  });
		
			  //拖拽上传
			  upload.render({
			    elem: '#test2'
			    ,url: '/admin/import2'
			    	,exts: 'xlsx|xls' //只允许上传压缩文件
			    	
			    ,done: function(res){
			    	if(res.errorNo=='0'){
				    	   layer.msg("导入成功");
				       }else{
				    	   layer.msg(res.errorInfo);
				       }
			    }
			  });
			  
			  //拖拽上传
			  upload.render({
			    elem: '#test3'
			    ,url: '/admin/import3'
			    	,exts: 'xlsx|xls' //只允许上传压缩文件
			    ,done: function(res){
			    	if(res.errorNo=='0'){
				    	   layer.msg("导入成功");
				       }else{
				    	   layer.msg(res.errorInfo);
				       }
			    }
			  });
			  
			  //拖拽上传
			  upload.render({
			    elem: '#test4'
			    ,url: '/admin/import4'
			    	,exts: 'xlsx|xls' //只允许上传压缩文件
			    ,done: function(res){
			    	if(res.errorNo=='0'){
				    	   layer.msg("导入成功");
				       }else{
				    	   layer.msg(res.errorInfo);
				       }
			    }
			  });
			  
			  
			  //拖拽上传
			  upload.render({
			    elem: '#test5'
			    ,url: '/admin/import5'
			    	,exts: 'xlsx|xls' //只允许上传压缩文件
			    ,done: function(res){
			    	if(res.errorNo=='0'){
				    	   layer.msg("导入成功");
				       }else{
				    	   layer.msg(res.errorInfo);
				       }
			    }
			  });
			  
			  //拖拽上传
			  upload.render({
			    elem: '#test6'
			    ,url: '/admin/import6'
			    	,exts: 'xlsx|xls' //只允许上传压缩文件
			    ,done: function(res){
			    	if(res.errorNo=='0'){
				    	   layer.msg("导入成功");
				       }else{
				    	   layer.msg(res.errorInfo);
				       }
			    }
			  });
			  
			  
			  //拖拽上传
			  upload.render({
			    elem: '#test7'
			    ,url: '/admin/import7'
			    	,exts: 'xlsx|xls' //只允许上传压缩文件
			    ,done: function(res){
			    	if(res.errorNo=='0'){
				    	   layer.msg("导入成功");
				       }else{
				    	   layer.msg(res.errorInfo);
				       }
			    }
			  });
			  
			  
			  //拖拽上传
			  upload.render({
			    elem: '#test8'
			    ,url: '/admin/import8'
			    	,exts: 'xlsx|xls' //只允许上传压缩文件
			    ,done: function(res){
			    	if(res.errorNo=='0'){
				    	   layer.msg("导入成功");
				       }else{
				    	   layer.msg(res.errorInfo);
				       }
			    }
			  });
			  
			  
			//自定义验证规则  
			  form.verify({  
				 huiNumber: [/^[A-Za-z0-9]+$/, '会员编号只能输入字母或数字！']
			     ,huiTjrNum: [/^[A-Za-z0-9]+$/, '推荐人编号只能输入字母或数字！']
			     ,huiJdrNum: [/^[A-Za-z0-9]+$/, '接点人编号只能输入字母或数字！']
			     ,huiPhone: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！']   
			  });  
			
			 //监听提交(发送消息)
			  form.on('submit(huiregsubmit)', function(data){
				/*             layer.alert(JSON.stringify(data.field), {
	               title: '最终的提交信息'
	        })    */
				   //对话框
	  			   	  layer.confirm('您确定要修改吗？', function(index){
	  			   		 //发送请求  admin 指向后台 sendmsg 后台方法
	  			          $.post('/admin/addhuiuserinfo',
	  			   	    		data.field,//这个是表单序列化值
	  			   	    		function(obj){
	  			   	    	          if(obj.Status=='ok'){
	  			   	    	        	layer.msg('修改成功');
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
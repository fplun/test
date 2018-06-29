<html><head>
  <meta charset="utf-8">
  <title>消息中心</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
   <script src="/layui/js/jquery-1.10.2.min.js"></script>
	<script src="/layui/js/settime.js"></script>
	<script src="/layui/layui-v2.2.5/layui/layui.js"></script>
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"><script type="text/javascript" src="/layui/js/settimeqt.js"></script><link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
<body layadmin-themealias="green" style="">
<div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
				    <div class="layui-field-box">
<form class="layui-form" action="">
							   <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
							  <legend>系统开关设置</legend>
							</fieldset>
							
							<div class="layui-form-item">
							    <label class="layui-form-label">提币开关</label>
							    <div class="layui-input-block">
							      <input name="close" type="checkbox" id="tbopcl" checked="" lay-filter="sexDemo" lay-skin="switch" lay-text="开|关"><div class="layui-unselect layui-form-switch layui-form-onswitch" lay-skin="_switch"><em>开</em><i></i></div>
							    </div>
							  </div>
							<!--   
							  <div class="layui-form-item">
							    <label class="layui-form-label">锁仓开关</label>
							    <div class="layui-input-block">
							      <input name="close" type="checkbox"  id="scsitch"  checked  lay-filter="sexDemo"  lay-skin="switch" lay-text="开|关">
							    </div>
							  </div> -->
							 <!--    <div class="layui-form-item">
							    <label class="layui-form-label">代币积分提取开关</label>
							    <div class="layui-input-block">
							      <input name="close" type="checkbox"  id="scsitch"  checked  lay-filter="sexDemo"  lay-skin="switch" lay-text="开|关">
							    </div>
							  </div>
							  <div class="layui-form-item">
							    <label class="layui-form-label">三级分销手动开关</label>
							    <div class="layui-input-block">
							      <input name="close" type="checkbox"  id="sjfxtch"  checked  lay-filter="sexDemo"  lay-skin="switch" lay-text="开|关">
							    </div>
							  </div> -->
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
			  var index = layedit.build('demo', {
					hideTool: ['image']
					,uploadImage: {
					    url: '/admin/upload' //接口url
					    ,type: '' //默认post
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
			
			   //监听公告操作
	        form.on('switch(sexDemo)', function(obj){
	            var s;
	            if(obj.elem.checked){//打开
	                s=1;
	            }else{//关闭
	                s=0;
	            }
	            if(obj.elem.id=='scsitch'){
	            	 $.ajax({
	 	                type: "POST",
	 	                async:false,
	 	                dataType: "json",
	 	                url: "/admin/nbupdatecx",
	 	                data:{
	 	                    iscx:s,
	 	                    id:3
	 	                },
	 	                success: function (obj) {
	 	                    if(obj.Status=='ok'){
	 	                        if(s==1){
	 	                            layer.msg('打开成功');
	 	                        }
	 	                        if(s==0){
	 	                            layer.msg('关闭成功');
	 	                        }
	 	                    }else{
	 	                        layer.msg('操作失败');
	 	                    }
	 	                },
	 	                error: function(data) {
	 	                    alert("网络错误");
	 	                }
	 	            }); 
	            }else if(obj.elem.id=='sjfxtch'){
	            	 $.ajax({
		 	                type: "POST",
		 	                async:false,
		 	                dataType: "json",
		 	                url: "/admin/nbupdatecx",
		 	                data:{
		 	                    iscx:s,
		 	                    id:11
		 	                },
		 	                success: function (obj) {
		 	                    if(obj.Status=='ok'){
		 	                        if(s==1){
		 	                            layer.msg('打开成功');
		 	                        }
		 	                        if(s==0){
		 	                            layer.msg('关闭成功');
		 	                        }
		 	                    }else{
		 	                        layer.msg('操作失败');
		 	                    }
		 	                },
		 	                error: function(data) {
		 	                    alert("网络错误");
		 	                }
		 	            }); 
		            } 
	            else if(obj.elem.id=='tbopcl'){
	            	 $.ajax({
	 	                type: "POST",
	 	                async:false,
	 	                dataType: "json",
	 	                url: "/admin/nbupdatecx",
	 	                data:{
	 	                    iscx:s,
	 	                    id:2
	 	                },
	 	                success: function (obj) {
	 	                    if(obj.Status=='ok'){
	 	                        if(s==1){
	 	                            layer.msg('打开成功');
	 	                        }
	 	                        if(s==0){
	 	                            layer.msg('关闭成功');
	 	                        }
	 	                    }else{
	 	                        layer.msg('操作失败');
	 	                    }
	 	                },
	 	                error: function(data) {
	 	                    alert("网络错误");
	 	                }
	 	            }); 
	            } 
	        });
			
			 //监听提交
			  form.on('submit(msgsubmit)', function(data){
				   //对话框
	  			   	 layer.confirm('您确定要提交吗？', function(index){
	  			   		 //发送请求  admin 指向后台 sendmsg 后台方法
	  			          $.post('/admin/configsub',
	  			   	    		data.field,//这个是表单序列化值
	  			   	    		function(obj){
	  			   	    	          if(obj.Status=='ok'){
	  			   	    	        	layer.msg('修改成功');
	  			   	    	        	parent.closeadd();
	  			   	    	          }else{
	  			   	    	        	layer.msg('修改失败');
	  			   	    	          }
	  		            	});	 
	  				 });
			    return false;
			  });		 
		});
	</script>
</body></html>
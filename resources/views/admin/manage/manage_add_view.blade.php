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
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
<script type="text/javascript" src="/layui/js/settimeqt.js"></script>
<link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
<body layadmin-themealias="green">
  <div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
				    <div class="layui-field-box">
						               <form class="layui-form layui-form-pane" action="">
														  <div class="layui-form-item">
														    <label class="layui-form-label">管理员账号</label>
														    <div class="layui-input-block">
														      <input type="text" name="username" autocomplete="off" lay-verify="required" placeholder="请输入管理员账号" class="layui-input">
														    </div>
														  </div>

                                                          <div class="layui-form-item">
														    <label class="layui-form-label">管理员密码</label>
														    <div class="layui-input-block">
														      <input name="password" class="layui-input" type="password" lay-verify="required" placeholder="请输入密码" autocomplete="off">
														    </div>
														  </div>														  

													 <!-- <div class="layui-form-item">
															    <label class="layui-form-label">系统权限</label>
															    <div class="layui-input-block">
															    <input type="hidden" id="midsinput" name="mids" value="1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,">
																	    <input type="checkbox" lay-filter="midcheck" title="新闻公告管理" id="1" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>新闻公告管理</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="内部消息管理" id="2" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>内部消息管理</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="注册新会员" id="3" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>注册新会员</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="未开通会员" id="4" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>未开通会员</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="已开通会员" id="5" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>已开通会员</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="冻结会员管理" id="6" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>冻结会员管理</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="所有会员列表" id="7" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>所有会员列表</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="配套管理" id="8" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>配套管理</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="推荐网络查看" id="9" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>推荐网络查看</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="接点网络查看" id="10" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>接点网络查看</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="分享补贴查询" id="11" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>分享补贴查询</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="会员账号维护" id="12" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>会员账号维护</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="会员充值管理" id="13" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>会员充值管理</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="会员提款管理" id="14" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>会员提款管理</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="账户明细查询" id="15" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>账户明细查询</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="拨出率统计" id="16" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>拨出率统计</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="授权账号管理" id="17" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>授权账号管理</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="管理员密码修改" id="18" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>管理员密码修改</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="系统开关设置" id="19" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>系统开关设置</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="系统安全设置" id="20" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>系统安全设置</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="奖金参数设置" id="21" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>奖金参数设置</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="数据结算管理" id="22" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>数据结算管理</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="会员日志查看" id="23" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>会员日志查看</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="管理员日志查看" id="24" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>管理员日志查看</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="股数交易流设置" id="25" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>股数交易流设置</span><i class="layui-icon"></i></div>
																	    <input type="checkbox" lay-filter="midcheck" title="数据导入" id="26" checked=""><div class="layui-unselect layui-form-checkbox layui-form-checked" lay-skin=""><span>数据导入</span><i class="layui-icon"></i></div>
															    </div>
															  </div> -->
															  
														  <div class="layui-form-item">
														    <button class="layui-btn" lay-submit="" lay-filter="msgsubmit">确认提交</button>
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
			
			form.on('checkbox(midcheck)', function(data){
				  //console.log(data.elem); //得到checkbox原始DOM对象
				  //console.log(data.elem.checked); //是否被选中，true或者false
				  //console.log(data.value); //复选框value值，也可以通过data.elem.value得到
				  //console.log(data.othis); //得到美化后的DOM对象
				  if(data.elem.checked){
					  var mid = data.elem.id;
					  var midinput = $("#midsinput").val();
					  midinput+=mid+",";
					  $("#midsinput").val(midinput);
				  }else{
					  var mid = data.elem.id;
					  var midinput = $("#midsinput").val();
					  midinput=midinput.replace(mid+",","");
					  $("#midsinput").val(midinput);
				  }
				});     
			
			 //监听提交(发送消息)
			  form.on('submit(msgsubmit)', function(data){
	/* 			  layer.alert(JSON.stringify(data.field), {
				      title: '最终的提交信息'
				    }) */
			          $.post('/admin/manage_add',
			   	    		data.field,//这个是表单序列化值
			   	    		function(obj){
			   	    	          if(obj.Status=='ok'){
			   	    	        	layer.msg('提交成功');
			   	    	        	parent.closeadd();
			   	    	          }else{
			   	    	        	layer.msg(obj.Erro);
			   	    	          }
		            	});	  
			    return false;
			  });		 
		});
	</script>
</body></html>
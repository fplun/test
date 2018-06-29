<html><head>
  <meta charset="utf-8">
  <title>消息中心</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
	<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
	<script src="/layui/js/jquery-1.10.2.min.js"></script>
	<script src="/layui/js/settime.js"></script>
	<script src="/layui/layui-v2.2.5/layui/layui.js"></script>
<script type="text/javascript" src="/layui/js/settimeqt.js"></script>
<link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
<body layadmin-themealias="green">

  <div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
      <div class="layui-tab layui-tab-brief" lay-filter="msgtab">
        <ul class="layui-tab-title">
          <li class="layui-this" id="sjxlilist">收件箱</li>
          <li id="fjxlilist">发件箱<!-- <span class="layui-badge">6</span> --></li>
          <li>发送邮件</li>
        </ul>
        <div class="layui-tab-content">
          <div class="layui-tab-item layui-show">
                  <table id="sjxtablelist" lay-filter="tablelist"></table>
          </div>
          <div class="layui-tab-item">
                   <table id="fjxtablelist" lay-filter="tablelist"></table>
         </div>
          <div class="layui-tab-item">
                 <div class="LAY-app-message-btns" style="margin-bottom: 10px;">
		              <form class="layui-form layui-form-pane" action="">
								               <div class="layui-form-item">
														 <label class="layui-form-label">发件人编号</label>
													 <div class="layui-input-inline">
															  <input type="text" lay-verify="required" readonly="readonly" value="{{$admin->username}}" placeholder="请输入" autocomplete="off" class="layui-input">
												     </div>
										  </div>
										  
										  <div class="layui-form-item">
																    <label class="layui-form-label">收件人编号</label>
																    <div class="layui-input-inline">
																      <input type="text" name="receive" lay-verify="required" placeholder="请输入收件人编号" autocomplete="off" class="layui-input">
																    </div>
										  </div>
										  
										  <div class="layui-form-item">
										    <label class="layui-form-label">消息标题</label>
										    <div class="layui-input-block">
										      <input type="text" name="title" autocomplete="off" lay-verify="required" placeholder="请输入消息标题" class="layui-input">
										    </div>
										  </div>
										 
										  
										  <div class="layui-form-item layui-form-text">
										    <label class="layui-form-label">消息内容</label>
										    <div class="layui-input-block">
										      <textarea placeholder="请输入消息内容" lay-verify="required" name="content" class="layui-textarea"></textarea>
										    </div>
										  </div>
										  <div class="layui-form-item">
										    <button class="layui-btn" lay-submit="" lay-filter="msgsubmit">发送</button>
										  </div>
										</form>
               </div> 
          </div>
          </div>
        </div>
      </div>
    </div>  

	<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
	<script>
		layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element'], function(){
			var $ = layui.jquery
					, layer = layui.layer //独立版的layer无需执行这一句
					,form = layui.form
					,table = layui.table//数据表格
			,element = layui.element
			 ,upload = layui.upload;
			
			
			element.on('tab(msgtab)', function(data){
				 // console.log(this); //当前Tab标题所在的原始DOM元素
				  //console.log(data.index); //得到当前Tab的所在下标
				 // console.log(data.elem); //得到当前的Tab大容器
				 if(data.index==0){
					   initsjx();
				 }else if(data.index==1){
					   initfjx();
				 }
				});
			
			
			 //监听提交(发送消息)
			  form.on('submit(msgsubmit)', function(data){
				  /*    layer.alert(JSON.stringify(data.field), {
			               title: '最终的提交信息'
			        })    */
			        
					layer.confirm('您确定要发送吗？', function(index){
					//发送请求  admin 指向后台 sendmsg 后台方法
						$.post('/admin/send_make',
							data.field,//这个是表单序列化值
							function(obj){
											if(obj.Status=='ok'){
											layer.msg('发送成功');
											}else{
											layer.msg(obj.Erro);
											}
							});	 
					});
			    return false;
			  });
			var addLaer;
			 //监听工具条
			  table.on('tool(tablelist)', function(obj){
			    var data = obj.data;
			    if(obj.event === 'detailsjx'){
			      //layer.msg('ID：'+ data.id + ' 的查看操作');
			    	addLaer=layer.open({
		                type: 2 //此处以iframe举例
		                ,title: data.nb_title
		                ,area: ['50%', '50%']
		                ,shade: 0
		                ,content: '/admin/look_notice?id='+data.id
		                ,yes: function(){
		                    $(that).click();
		                }
		                ,btn2: function(){
		                    layer.closeAll();
		                }
		                ,zIndex: layer.zIndex //重点1
		                ,success: function(layero){
		                }
		            });
			    } else if(obj.event === 'delsjx'){
			    	layer.confirm('确定要删除该条消息?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/inbox_delete",
	                        data:{
	                            id:data.id
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                            	obj.del();
	                                layer.msg('删除成功');
	                            }else{
	                                layer.msg('操作失败');
	                            }
	                        },
	                        error: function(data) {
	                            alert("网络错误");
	                        }
	                    });
	                    layer.close(index);
	                  });
			    }  
			  });
			
	        initfjx();
			function initfjx(){
				//发件箱
				table.render({
					elem: '#fjxtablelist'
					,url:'/admin/get_outbox'
					,cols: [[
						 {field:'senduserinfo', title: '发件人信息'}
						 ,{field:'creattime',title: '发件人时间'}
		                    ,{field:'status', title: '查看状态', templet: '#msgstatus'}
		                    ,{field:'', title: '操作', sort: false, templet: '#barmsg'}
					]]
					,page: true
				});
			}
			
			initsjx();
			function initsjx(){
				//发件箱
				table.render({
					elem: '#sjxtablelist'
					,url:'/admin/get_inbox'
					,cols: [[
						 {field:'senduserinfo', title: '发件人信息'}
						 ,{field:'creattime',title: '发件人时间'}
		                    ,{field:'status', title: '查看状态', templet: '#msgstatus'}
		                    ,{field:'', title: '操作', sort: false, templet: '#barmsg'}
					]]
					,page: true
				});
			}
		});
	</script>
		 <script type="text/html" id="barmsg">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">查看</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">删除</a>
       </script>
       	 <script id="msgstatus" type="text/html">
		<label >@{{ d.status== 0 ? '未读' :'已读' }}</label>
	</script>
</body></html>
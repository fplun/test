<html><head>
  <meta charset="utf-8">
  <title>消息中心</title>
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
          <fieldset class="layui-elem-field">
             <legend>已开通会员管理</legend>
              <!--会员-->
            <div class="demoTable" id="yhdiv" style="display: black">
                                编号：
                <div class="layui-inline">
                    <input class="layui-input" name="id" id="acc" autocomplete="off">
                </div>
                 <div class="layui-inline">
				      <label class="layui-form-label">注册时间：</label>
				      <div class="layui-input-inline">
				        <input name="date" class="layui-input" id="date" type="text" placeholder="yyyy-MM-dd" autocomplete="off" lay-verify="date" lay-key="1">
				      </div>
			     </div>
			     <div class="layui-inline">
				      <label class="layui-form-label" style="margin-left:-80px;">-</label>
				      <div class="layui-input-inline">
				        <input name="date" class="layui-input" id="date1" type="text" placeholder="yyyy-MM-dd" autocomplete="off" lay-verify="date" lay-key="2">
				      </div>
			     </div>
                <button class="layui-btn" data-type="reload" id="jySearchBtn">搜索</button>
            </div>
			  <div class="layui-field-box">
			     <table id="sjxtablelist" lay-filter="tablelist"></table>
			  </div>
         </fieldset>
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
			,laydate = layui.laydate
			 ,upload = layui.upload;
			
		      
	        //日期
	        laydate.render({
	          elem: '#date'
	        });
	        laydate.render({
	          elem: '#date1'
	        });
			
			 //会员查询按钮
	        $('#jySearchBtn').on('click', function(){
	        	initsjx();
	        });
			
			 //监听工具条
			  table.on('tool(tablelist)', function(obj){
			    var data = obj.data;
			    if(obj.event === 'detailsjx'){
			    	addLaer=layer.open({
		                type: 2 //此处以iframe举例
		                ,title: data.nb_title
		                ,area: ['90%', '100%']
		                ,shade: 0
		                ,content: '/admin/user_edit?id='+data.id
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
			    	layer.confirm('确定要冻结?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/frozen_make",
	                        data:{
	                            id:data.id,
	                            status:'1'
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                            	obj.del();
	                                layer.msg('封号成功');
	                            }else{
	                                layer.msg(data.Erro);
	                            }
	                        },
	                        error: function(data) {
	                            alert("网络错误");
	                        }
	                    });
	                    layer.close(index);
	                  });
			    } else if(obj.event === 'dynamic_frozen'){
			    	layer.confirm('确定要冻结?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/dynamic_make",
	                        data:{
	                            id:data.id,
								state:1
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                                layer.msg('冻结动态收益成功');
									initsjx();
	                            }else{
	                                layer.msg(data.Erro);
	                            }
	                        },
	                        error: function(data) {
	                            alert("网络错误");
	                        }
	                    });
	                    layer.close(index);
	                  });
			    }  else if(obj.event === 'dynamic_thaw'){
			    	layer.confirm('确定要解冻?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/dynamic_make",
	                        data:{
	                            id:data.id,
								state:2
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                                layer.msg('解冻动态收益成功');
									initsjx();
	                            }else{
	                                layer.msg(data.Erro);
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
			
	       window.closeadd = function(){
				    layer.closeAll();
					initsjx();
			 }  
			 
			window.initsjx =  function(){
				table.render({
					elem: '#sjxtablelist'
					,url:'/admin/get_open?t=1&status=0&acc='+$("#acc").val()+"&start="+$("#date").val()+"&end="+$("#date1").val()
					,cols: [[
						 {field:'username', title: '会员编号'}
						 ,{field:'name',title: '会员姓名'}
						 ,{field:'recommend',title: '推荐人'}
						 ,{field:'lock',title: 'ATEC(锁仓)'}
						 ,{field:'release',title: 'ATEC(活期)'}
						 ,{field:'register',title: '激活币'}
		                 ,{field:'', title: '操作', sort: false, templet: '#barmsg'}
						 ,{field:'', title: '登入', sort: false, templet: '#barmsg1'}
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>
		 <script type="text/html" id="barmsg">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx" title="会员资料修改">编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx" title="封号">封号</a>

				@{{ d.dynamic_type==0?'<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="dynamic_frozen" title="冻结动态收益">冻结动态收益</a>':'<a class="layui-btn layui-btn-xs" lay-event="dynamic_thaw" title="解冻动态收益">解冻动态收益</a>'}}
	   </script>
	   <script type="text/html" id="barmsg1">
                
<a href="/admin/user_login/@{{d.id}}" class="layui-btn layui-btn-danger layui-btn-xs"  title="登入" target="view_window">登入</a>
	   </script>
       	 <script id="msgstatus" type="text/html">
		<label ></label>
	</script>
	 <script id="levelbar" type="text/html">
		<label ></label>
	</script>
</body></html>
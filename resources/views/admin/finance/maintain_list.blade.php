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
             <legend>会员账户维护</legend>
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
                 <button class="layui-btn" data-type="reload" id="jySearchBtn">导出</button>
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
			var addLaer;
			 //监听工具条
			  table.on('tool(tablelist)', function(obj){
			    var data = obj.data;
			    if(obj.event === 'agio'){
			        //layer.msg('ID：'+ data.id + ' 的查看操作');
			    	addLaer=layer.open({
		                type: 2 //此处以iframe举例
		                ,title: '抵扣币赠送'
		                ,area: ['513px', '251px']
		                ,shade: 0
		                ,content: '/admin/recharge?id='+data.id+'&type=1'
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
			    }else  if(obj.event === 'register'){
			    	addLaer=layer.open({
		                type: 2 //此处以iframe举例
		                ,title: '注册码充值'
		                    ,area: ['513px', '251px']
		                ,shade: 0
		                ,content: '/admin/recharge?id='+data.id+'&type=2'
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
			    } else  if(obj.event === 'zcjfev'){
			    	addLaer=layer.open({
		                type: 2 //此处以iframe举例
		                ,title: '其他充值'
		                ,area: ['30%', '30%']
		                ,shade: 0
		                ,content: '/admin/recharge?id='+data.id+'&type=3'
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
			    } else  if(obj.event === 'zyl_money'){
			    	addLaer=layer.open({
		                type: 2 //此处以iframe举例
		                ,title: '激活币充值'
		                    ,area: ['513px', '251px']
		                ,shade: 0
		                ,content: '/admin/recharge?id='+data.id+'&type=3'
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
			    }
			  });
			
	       window.closeadd = function(){
				    layer.closeAll();
					initsjx();
			 }  
			 
			window.initsjx =  function(){
				table.render({
					elem: '#sjxtablelist'
					,url:'/admin/get_maintain_list?acc='+$("#acc").val()+"&type=1&start="+$("#date").val()+"&end="+$("#date1").val()
					,cols: [[
						 {field:'username', title: '会员编号'}
						 ,{field:'name',title: '会员姓名'}
						 ,{field:'agio',title: '注册币'}
						 ,{field:'hui_jh_jf',title: '注册币赠送', templet: '#agio'}
						 ,{field:'register',title: '激活币'}
						 ,{field:'zyl_money',title: '众易链币'}
						 /* ,{field:'hui_zcjf',title: '注册币充值', templet: '#register'} */
						 ,{field:'hui_zcjf',title: '众易链币充值', templet: '#zyl_money'} 
						 ,{field:'created_at',title: '注册时间'}
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>
		 <script type="text/html" id="agio">
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="agio">充值</a>
       </script>
        <script type="text/html" id="register">
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="register">充值</a>
       </script>
	   <script type="text/html" id="zyl_money">
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="zyl_money">充值</a>
       </script>
</body></html>
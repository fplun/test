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
             <legend>会员提款管理</legend>
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
	var thid;
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
			    if(obj.event === 'delsjxno'){
			    	thid = data.id;
			    	 layer.confirm('您确定要不通过吗？', function(index){
			    		 //多窗口模式，层叠置顶
			             addLaer=layer.open({
			                 type: 2 //此处以iframe举例
			                 ,title: '填写退回原因'
			                 ,area: ['80%', '80%']
			                 ,shade: 0
			                 ,content: '/admin/recharge_no_pass'
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
			 		    return false;
			 		  });
	  			         
			    } else if(obj.event === 'delsjx'){
			    	layer.confirm('确定要通过?', function(index){
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/extracts_make",
	                        data:{
	                            id:data.id,
		                            state:1
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                                layer.msg('处理成功');
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
			    }  else if(obj.event === 'tuyl'){
			    	addLaer=layer.open({
		                type: 1 //此处以iframe举例
		                ,title: '预览'
		                ,area: ['90%', '90%']
		                ,shade: 0
		                ,content: '<img  style=cursor:pointer  src='+data.voucher+' />'
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
			 
	  	 window.getyy= function (yy){
    		 $.post('/admin/extracts_make',
			             {
			             no_pass:yy,
		                 id:thid,
		                state:2
		                        },
			   	    		function(obj){
			   	    	          if(obj.Status=='ok'){
			   	    	        	layer.msg('处理成功');
			   	    	   	        initsjx();
			   	    	   	  layer.closeAll();
			   	    	          }else{
			   	    	        	layer.msg(obj.Erro); 
			   	    	          }
		            	});	 
		  }
			window.initsjx =  function(){
				table.render({
					elem: '#sjxtablelist'
					,url:'/admin/get_extracts?acc='+$("#acc").val()+"&start="+$("#date").val()+"&end="+$("#date1").val()
					,cols: [[
						 {field:'username', title: '会员编号'}
						 ,{field:'type',title:'提币种类'}
						 ,{field:'address',title:'提币地址'}
                         ,{field:'all_money',title: '总金额'}
						 ,{field:'money',title: '充值金额'}
                         ,{field:'consume',title: '消费积分'}
                         ,{field:'interest',title: '手续费'}
						 /* ,{field:'voucher',title: '汇款凭证', templet: '#tupbar'} */
						 ,{field:'handle_at',title: '处理时间'}
						 ,{field:'no_pass',title: '审核不通过原因'}
						 ,{field:'state',title: '状态'}
						 ,{field:'created_at',title: '充值时间'}
						 ,{field:'',title: '操作', templet: '#barmsg'}
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>
		 <script type="text/html" id="barmsg">
		 	@{{#  if(d.state == '未处理'){ }}
            	<a class="layui-btn  layui-btn-xs" lay-event="delsjx">通过</a><a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjxno">不通过</a>
			@{{#  } }}
		</script>
        <script id="tupbar" type="text/html">
		      <label ><img title="点我预览"  style="cursor:pointer"  src="@{{d.voucher}}"  lay-event="tuyl" /></label>
	</script>
        	 <script id="msgstatus" type="text/html">
		<label ></label>
	</script>
</body></html>
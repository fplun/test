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
             <legend>未激活会员管理</legend>
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
			 ,upload = layui.upload;
			var addLaer;			   
			   
			 //监听工具条
			  table.on('tool(tablelist)', function(obj){
			    var data = obj.data;
			    if(obj.event === 'detailsjx'){
			    	 layer.confirm('您确定要确认吗？', function(index){
	  			          $.post('/admin/open_make',
	  			             {
	  		                            id:data.id
	  		                        },
	  			   	    		function(obj){
	  			   	    	          if(obj.Status=='ok'){
	  			   	    	        	layer.msg('激活成功');
	  			   	    	       		initsjx();
	  			   	    	          }else{
	  			   	    	        	layer.msg(obj.Erro); 
	  			   	    	          }
	  		            	});	 
	  				 });  
			    } else if(obj.event === 'delsjx'){
			    	layer.confirm('确定要删除?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/delete_no_open",
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
			
	       window.closeadd = function(){
				    layer.closeAll();
					initsjx();
			 }  
			 
			window.initsjx =  function(){
				table.render({
					elem: '#sjxtablelist'
					,url:'/admin/get_no_open'
					,cols: [[
						 {field:'username', title: '会员编号'}
						 ,{field:'name',title: '会员姓名'}
						 ,{field:'register_money',title: '投资额度'}
						 ,{field:'recommend',title: '推荐人'}
						 ,{field:'created_at',title: '注册时间'}
		                 ,{field:'', title: '操作', sort: false, templet: '#barmsg'}
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>
		 <script type="text/html" id="barmsg">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">确认</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">删除</a>
       </script>
       	 <script id="msgstatus" type="text/html">
		<label ></label>
	</script>
	 <script id="levelbar" type="text/html">
		<label ></label>
	</script>
</body></html>
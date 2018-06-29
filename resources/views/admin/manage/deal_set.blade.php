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
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"><script type="text/javascript" src="/layui/js/settimeqt.js"></script><link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
<body layadmin-themealias="green" style="">

  <div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
          <fieldset class="layui-elem-field">
             <legend>股数交易流水设置</legend>
              <!--会员-->
            <div class="demoTable" id="yhdiv" style="display: black">
                <div class="layui-inline">
                  <label class="layui-form-label">日交易量：</label>
                      <div class="layui-input-inline">
				        <input class="layui-input" name="gqDaySum" value="12" id="gqDaySum" autocomplete="off">
				      </div>
                </div>日交易量(美金)： 
                               <div class="layui-inline">
                      <div class="layui-input-inline">
				        <input class="layui-input" name="gqDayPrice" value="1" id="gqDayPrice" autocomplete="off">
				      </div>
                </div> 
                总交易量： 
                <div class="layui-inline">
                      <div class="layui-input-inline">
				        <input class="layui-input" name="gqTotalSum" value="100" id="gqTotalSum" autocomplete="off">
				      </div>
                </div>
                总交易量(美金)： 
                 <div class="layui-inline">
                  
                      <div class="layui-input-inline">
				        <input class="layui-input" name="gqTotalPrice" value="1" id="gqTotalPrice" autocomplete="off">
				      </div>
                </div> 
                <button class="layui-btn" data-type="reload" id="jySearchBtn">保存</button>
              <!--    <button class="layui-btn" data-type="reload" id="jySearchBtn">导出数据</button> -->
            </div>
			  <div class="layui-field-box">
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
	        	  $.ajax({
                      type: "POST",
                      async:false,
                      dataType: "json",
                      url: "/admin/updategsjyls",
                      data:{
                    	  gqDaySum:$("#gqDaySum").val()
                    	  ,gqTotalSum:$("#gqTotalSum").val()
                    	  ,gqTotalPrice:$("#gqTotalPrice").val()
                    	  ,gqDayPrice:$("#gqDayPrice").val()
                      },
                      success: function (data) {
                          if(data.Status=='ok'){
                              layer.msg('保存成功');
                          }else{
                              layer.msg('操作失败');
                          }
                      },
                      error: function(data) {
                          alert("网络错误");
                      }
                  });
	        });
			
			 //监听工具条
			  table.on('tool(tablelist)', function(obj){
			    var data = obj.data;
			    if(obj.event === 'detailsjx'){
			    	 layer.confirm('您确定要处理此次会员提币申请吗？', function(index){
	  			          $.post('/admin/updatetmoney',
	  			             {
	  		                            id:data.id,
	  		                           huinumber:data.ho_hui_num
	  		                        },
	  			   	    		function(obj){
	  			   	    	          if(obj.Status=='ok'){
	  			   	    	        	layer.msg('处理成功');
	  			   	    	       initsjx();
	  			   	    	          }else{
	  			   	    	        	layer.msg(obj.Erro); 
	  			   	    	          }
	  		            	});	 
	  				 });  
			    } else if(obj.event === 'delsjx'){
			    	layer.confirm('确定要提到E链数字信誉托管平台吗？', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/tbelian",
	                        data:{
	                        	  id:data.id,
 		                           huinumber:data.ho_hui_num
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                                layer.msg('提币成功');
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
			    }  else if(obj.event === 'tuijsjx'){
			    	layer.confirm('确定要退提吗？', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/tuijupdate",
	                        data:{
	                            id:data.id
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                                layer.msg('退提成功');
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
					,url:'/admin/huitmoneylist?acc='+$("#acc").val()+"&start="+$("#date").val()+"&end="+$("#date1").val()
					,cols: [[
						 {field:'ho_hui_num', title: '会员编号'}
						 ,{field:'ho_tb_type',title: '提币种类'}
						 ,{field:'ho_js_address',title: '接收地址'}
						 ,{field:'ho_tb_jj',title: '提币奖金'}
						 ,{field:'ho_sfmoney',title: '实发金额'}
						 ,{field:'ho_jf',title: '积分'}
						 ,{field:'ho_tk_time',title: '提款时间'}
						 ,{field:'status',title: '状态', templet: '#msgstatus'}
						 ,{field:'',title: '操作', templet: '#barmsg'}
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>
		 <script type="text/html" id="barmsg">
               <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">处理</a><a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="tuijsjx">退提</a><a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="delsjx">提E链</a>
       </script>
       	 <script id="msgstatus" type="text/html">
		<label ></label>
	</script>
</body></html>
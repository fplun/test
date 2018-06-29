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
             <legend>套餐管理</legend>
              <!--会员-->
            <div class="demoTable" id="yhdiv" style="display: black">
                                编号：
                <div class="layui-inline">
                    <input class="layui-input" name="id" id="acc" autocomplete="off">
                </div>
                 <div class="layui-inline">
				      <label class="layui-form-label">时间：</label>
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
			
			//监听单元格编辑
			  table.on('edit(tablelist)', function(obj){
			    var value = obj.value //得到修改后的值
			    ,data = obj.data //得到所在行所有键值
			    ,field = obj.field; //得到字段
			    var reg = /(^[1-9]([0-9]+)?(\.[0-9]{1,2})?$)|(^(0){1}$)|(^[0-9]\.[0-9]([0-9])?$)/;
			     //var money = "520.100";
			     //000 错
			     //0 对
			     //0. 错
			     //0.0 对
			     //050 错
			     //00050.12错
			     //70.1 对
			     //70.11 对
			     //70.111错
			     //500 正确
			     if (!reg.test(value)) {
			    		layer.msg('[错误]:只能输入数字,小数点后两位')
			        }else{
			        	if(field=='tc_curr_price'){
			        		layer.confirm('您确定要修改会员：'+data.tc_hui_num+'当前价格吗？', function(index){
					        	  $.ajax({
					                    type: "POST",
					                    async:false,
					                    dataType: "json",
					                    url: "/admin/updatecurrprice",
					                    data:{
					                        id:data.id,
					                        newp:value
					                    },
					                    success: function (res) {
					                    	if(res.Status=='ok'){
					                    		layer.msg('[成功: '+ data.tc_hui_num +']  当前价格更改为：'+ value)
					                    	}
					                    },
					                    error: function(data) {
					                        alert("网络错误");
					                    }
					                });
			        	   });  
			          }else if(field=='tc_xzyj_price'){
			        	  layer.confirm('您确定要修改会员：'+data.tc_hui_num+'新增业绩吗？', function(index){
				        	  $.ajax({
				                    type: "POST",
				                    async:false,
				                    dataType: "json",
				                    url: "/admin/updatexzyj",
				                    data:{
				                        id:data.id,
				                        newp:value
				                    },
				                    success: function (res) {
				                    	if(res.Status=='ok'){
				                    		layer.msg('[成功: '+ data.tc_hui_num +']  新增业绩更改为：'+ value)
				                    	}
				                    },
				                    error: function(data) {
				                        alert("网络错误");
				                    }
				                });
		        	   });  
			          }
			        	}
			    //layer.msg('[ID: '+ data.id +'] ' + field + ' 字段更改为：'+ value);
			  });
			
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
			      //layer.msg('ID：'+ data.id + ' 的查看操作');
			    	addLaer=layer.open({
		                type: 2 //此处以iframe举例
		                ,title: data.nb_title
		                ,area: ['90%', '100%']
		                ,shade: 0
		                ,content: '/admin/toupdatehui.html?id='+data.id
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
                    $.ajax({
                        type: "POST",
                        async:false,
                        dataType: "json",
                        url: "/admin/loginhui",
                        data:{
                            id:data.id 
                        },
                        success: function (data) {
                        	if(data.Status=='ok'){
                        		window.open("/adminloginhui"); 
                        	}
                        },
                        error: function(data) {
                            alert("网络错误");
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
					,url:'/admin/get_matching_list?acc='+$("#acc").val()+"&start="+$("#date").val()+"&end="+$("#date1").val()
					,cols: [[
						 {field:'username', title: '会员编号'}
						 ,{field:'name',title: '会员姓名'}
						 ,{field:'money',title: '锁仓金额'}
						 ,{field:'surplus_day',title: '剩余锁仓天数'}
						 ,{field:'release_money',title: '释放金额'}
						 ,{field:'created_at',title: '订单时间'}

		                 /* ,{field:'', title: '操作', sort: false, templet: '#barmsg'} */
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>
		 <script type="text/html" id="barmsg">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">会员资料修改</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">登录会员界面</a>
       </script>
       	 <script id="msgstatus" type="text/html">
		<label ></label>
	</script>
	 	 <script id="dqja" type="text/html">
		<label > <a class="layui-btn layui-btn-danger layui-btn-xs">编辑</a></label>
	</script>
	 <script id="xzyj" type="text/html">
		<label class="layui-btn layui-btn-danger layui-btn-xs" title="点我编辑"></label> 
	</script>
</body></html>
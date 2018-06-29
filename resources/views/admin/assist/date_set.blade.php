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
      <div class="layui-tab layui-tab-brief">


<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>已结算到{{$last_time}}</legend>
</fieldset>
            <div class="layui-row">
					    <div class="layui-col-xs4">
					      <div class="grid-demo grid-demo-bg1" style="padding: 3px;">
					                 <button class="layui-btn layui-btn-fluid" id="jtjsbtn">手动结算 </button>
                          </div>
					    </div>
					    <!-- <div class="layui-col-xs4">
					      <div class="grid-demo" style="padding: 3px;">
					              <button class="layui-btn layui-btn-fluid" id="dtjsbtn">动态结算 </button>
                             </div>
					    </div> -->
					    <div class="layui-col-xs4">
					      <div class="grid-demo" style="padding: 3px;">
					            <button class="layui-btn layui-btn-fluid" id="qksjbtn">清空数据 </button>
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
			  

			
			//静态结算
			$('#jtjsbtn').on('click', function(){
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "/admin/manual_income", 
					success: function (obj) {
						if(obj.Status=='ok'){
							alert(obj.Text);
						}
					},
					error: function(data) {
						alert("网络错误");
					}
				});
				return false;
			});
			
			
			//动态结算
			$('#dtjsbtn').on('click', function(){
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "/admin/dtjs", 
					success: function (obj) {
						if(obj.Status=='ok'){
							alert("结算成功");
						}
					},
					error: function(data) {
						alert("网络错误");
					}
				});
				return false;
			});
			
			//清空数据
			$('#qksjbtn').on('click', function(){
				layer.confirm('确定要清空?', function(index){
					$.ajax({
						type: "POST",
						dataType: "json",
						url: "/admin/truncate_table", 
						success: function (obj) {
							if(obj.Status=='ok'){
								alert("清空数据成功");
							}
						},
						error: function(data) {
							alert("网络错误");
						}
					});
					layer.close(index);
				});
				return false;
			});
			
		});
	</script>
		 <script type="text/html" id="barmsg">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">查看</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">删除</a>
       </script>
       	 <script id="msgstatus" type="text/html">
		<label ></label>
	</script>
</body></html>
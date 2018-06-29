<html><head>
	<meta charset="utf-8">
	<title>layui</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
  <script src="/layui/js/jquery-1.10.2.min.js"></script>
	<script src="/layui/layui-v2.2.5/layui/layui.js"></script>
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
<script type="text/javascript" src="/layui/js/settimeqt.js"></script>
<link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
	<!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->

<body>
<form class="layui-form layui-form-pane" id="rpwdform" action="#" style="padding: 20px;">
	<div class="layui-form-item">
	         <input type="hidden" name="id" value="">
										  <div class="layui-field-box">
												    <textarea placeholder="退回原因" class="layui-textarea" id="treayy" style="height:130px;"></textarea>
										      </div>
										  </div>
									
				                          <div class="layui-form-item">
											   <div class="layui-field-box">
											   <div class="layui-inline">
											      <button class="layui-btn layui-btn-normal" lay-submit="" lay-filter="idcardszbtn">确定退回</button>
											    </div>
											    </div>
	</div>
</form>

<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
	layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element'], function(){
	    var $ = layui.jquery
	    , layer = layui.layer //独立版的layer无需执行这一句
	    ,form = layui.form
	    ,table = layui.table;//数据表格
	    
	  //监听提交(提交审核)
		  form.on('submit(idcardszbtn)', function(data){
		/*   layer.alert(JSON.stringify(data.field), {
		      title: '最终的提交信息'
		    })  */
		     var cannelyy = $("#treayy").val();
		     parent.getyy(cannelyy);
		    return false;
		  });
	});
</script>


</body></html>
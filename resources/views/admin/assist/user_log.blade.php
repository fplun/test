<html>

	<head>
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
		<link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all">
	</head>

	<body layadmin-themealias="green" style="">

		<div class="layui-fluid" id="LAY-app-message">
			<div class="layui-card">
				<fieldset class="layui-elem-field">
					<legend>会员日志查看</legend>
					<!--会员-->
					<div class="layui-field-box">
						<table id="sjxtablelist" lay-filter="tablelist"></table>
					</div>
				</fieldset>
			</div>
		</div>

		<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
		<script>
			layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element'], function() {
				var $ = layui.jquery,
					layer = layui.layer //独立版的layer无需执行这一句
					,
					form = layui.form,
					table = layui.table //数据表格
					,
					element = layui.element,
					laydate = layui.laydate,
					upload = layui.upload;

				//日期
				laydate.render({
					elem: '#date'
				});
				laydate.render({
					elem: '#date1'
				});

				//会员查询按钮
				$('#jySearchBtn').on('click', function() {
					initsjx();
				});

				window.closeadd = function() {
					layer.closeAll();
					initsjx();
				}

				window.initsjx = function() {
					table.render({
						elem: '#sjxtablelist',
						url: '/admin/get_user_log',
						cols: [
							[{
								field: 'username',
								title: '会员信息'
							}, {
								field: 'ip',
								title: 'IP'
							}, {
								field: 'created_at',
								title: '时间'
							}, {
								field: 'note',
								title: '日志信息'
							}]
						],
						page: true
					});
				}

				initsjx();
			});
		</script>
	</body>

</html>
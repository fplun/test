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
						<!--    <button class="layui-btn" data-type="reload" id="jySearchBtn">导出数据</button> -->
					</div>
					<div class="layui-field-box">
						<table id="sjxtablelist" lay-filter="tablelist"></table>
						<div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-1" style=" ">
							<div class="layui-table-box">
								<div class="layui-table-header">
									<table cellspacing="0" cellpadding="0" border="0" class="layui-table">
										<thead>
											<tr>
												<th data-field="ho_hui_num">
													<div class="layui-table-cell laytable-cell-1-ho_hui_num"><span>会员编号</span></div>
												</th>
												<th data-field="ho_tb_type">
													<div class="layui-table-cell laytable-cell-1-ho_tb_type"><span>提币种类</span></div>
												</th>
												<th data-field="ho_js_address">
													<div class="layui-table-cell laytable-cell-1-ho_js_address"><span>接收地址</span></div>
												</th>
												<th data-field="ho_tb_jj">
													<div class="layui-table-cell laytable-cell-1-ho_tb_jj"><span>提币奖金</span></div>
												</th>
												<th data-field="ho_sfmoney">
													<div class="layui-table-cell laytable-cell-1-ho_sfmoney"><span>实发金额</span></div>
												</th>
												<th data-field="ho_tk_time">
													<div class="layui-table-cell laytable-cell-1-ho_tk_time"><span>提款时间</span></div>
												</th>
												<th data-field="ho_node">
													<div class="layui-table-cell laytable-cell-1-ho_node"><span>退回原因</span></div>
												</th>
												<th data-field="status">
													<div class="layui-table-cell laytable-cell-1-status"><span>状态</span></div>
												</th>
												<th data-field="8">
													<div class="layui-table-cell laytable-cell-1-8"><span>操作</span></div>
												</th>
											</tr>
										</thead>
									</table>
								</div>
								<div class="layui-table-body layui-table-main">
									<table cellspacing="0" cellpadding="0" border="0" class="layui-table">
										<tbody>
											<tr data-index="0" class="">
												<td data-field="ho_hui_num">
													<div class="layui-table-cell laytable-cell-1-ho_hui_num">CN81975845</div>
												</td>
												<td data-field="ho_tb_type">
													<div class="layui-table-cell laytable-cell-1-ho_tb_type">ETH</div>
												</td>
												<td data-field="ho_js_address">
													<div class="layui-table-cell laytable-cell-1-ho_js_address">0x0cD127174cc8a05daCe4b2B17e185470b6351aD3</div>
												</td>
												<td data-field="ho_tb_jj">
													<div class="layui-table-cell laytable-cell-1-ho_tb_jj">10</div>
												</td>
												<td data-field="ho_sfmoney">
													<div class="layui-table-cell laytable-cell-1-ho_sfmoney">6</div>
												</td>
												<td data-field="ho_tk_time">
													<div class="layui-table-cell laytable-cell-1-ho_tk_time">2018-06-20 11:21:28</div>
												</td>
												<td data-field="ho_node">
													<div class="layui-table-cell laytable-cell-1-ho_node"></div>
												</td>
												<td data-field="status" data-content="1">
													<div class="layui-table-cell laytable-cell-1-status"> <label>已处理</label> </div>
												</td>
												<td data-field="8" data-content="">
													<div class="layui-table-cell laytable-cell-1-8"> </div>
												</td>
											</tr>
											<tr data-index="1" class="">
												<td data-field="ho_hui_num">
													<div class="layui-table-cell laytable-cell-1-ho_hui_num">a1</div>
												</td>
												<td data-field="ho_tb_type">
													<div class="layui-table-cell laytable-cell-1-ho_tb_type">ETH</div>
												</td>
												<td data-field="ho_js_address">
													<div class="layui-table-cell laytable-cell-1-ho_js_address">0x0cD127174cc8a05daCe4b2B17e185470b6351aD3</div>
												</td>
												<td data-field="ho_tb_jj">
													<div class="layui-table-cell laytable-cell-1-ho_tb_jj">50</div>
												</td>
												<td data-field="ho_sfmoney">
													<div class="layui-table-cell laytable-cell-1-ho_sfmoney">30</div>
												</td>
												<td data-field="ho_tk_time">
													<div class="layui-table-cell laytable-cell-1-ho_tk_time">2018-06-13 20:25:59</div>
												</td>
												<td data-field="ho_node">
													<div class="layui-table-cell laytable-cell-1-ho_node"></div>
												</td>
												<td data-field="status" data-content="1">
													<div class="layui-table-cell laytable-cell-1-status"> <label>已处理</label> </div>
												</td>
												<td data-field="8" data-content="">
													<div class="layui-table-cell laytable-cell-1-8"> </div>
												</td>
											</tr>
											<tr data-index="2" class="">
												<td data-field="ho_hui_num">
													<div class="layui-table-cell laytable-cell-1-ho_hui_num">a1</div>
												</td>
												<td data-field="ho_tb_type">
													<div class="layui-table-cell laytable-cell-1-ho_tb_type">ETH</div>
												</td>
												<td data-field="ho_js_address">
													<div class="layui-table-cell laytable-cell-1-ho_js_address">0x0cD127174cc8a05daCe4b2B17e185470b6351aD3</div>
												</td>
												<td data-field="ho_tb_jj">
													<div class="layui-table-cell laytable-cell-1-ho_tb_jj">50</div>
												</td>
												<td data-field="ho_sfmoney">
													<div class="layui-table-cell laytable-cell-1-ho_sfmoney">30</div>
												</td>
												<td data-field="ho_tk_time">
													<div class="layui-table-cell laytable-cell-1-ho_tk_time">2018-06-13 20:24:56</div>
												</td>
												<td data-field="ho_node">
													<div class="layui-table-cell laytable-cell-1-ho_node"></div>
												</td>
												<td data-field="status" data-content="1">
													<div class="layui-table-cell laytable-cell-1-status"> <label>已处理</label> </div>
												</td>
												<td data-field="8" data-content="">
													<div class="layui-table-cell laytable-cell-1-8"> </div>
												</td>
											</tr>
											<tr data-index="3" class="">
												<td data-field="ho_hui_num">
													<div class="layui-table-cell laytable-cell-1-ho_hui_num">a1</div>
												</td>
												<td data-field="ho_tb_type">
													<div class="layui-table-cell laytable-cell-1-ho_tb_type">ETH</div>
												</td>
												<td data-field="ho_js_address">
													<div class="layui-table-cell laytable-cell-1-ho_js_address">0x0cD127174cc8a05daCe4b2B17e185470b6351aD3</div>
												</td>
												<td data-field="ho_tb_jj">
													<div class="layui-table-cell laytable-cell-1-ho_tb_jj">100</div>
												</td>
												<td data-field="ho_sfmoney">
													<div class="layui-table-cell laytable-cell-1-ho_sfmoney">70</div>
												</td>
												<td data-field="ho_tk_time">
													<div class="layui-table-cell laytable-cell-1-ho_tk_time">2018-06-13 20:11:19</div>
												</td>
												<td data-field="ho_node">
													<div class="layui-table-cell laytable-cell-1-ho_node"></div>
												</td>
												<td data-field="status" data-content="1">
													<div class="layui-table-cell laytable-cell-1-status"> <label>已处理</label> </div>
												</td>
												<td data-field="8" data-content="">
													<div class="layui-table-cell laytable-cell-1-8"> </div>
												</td>
											</tr>
											<tr data-index="4" class="">
												<td data-field="ho_hui_num">
													<div class="layui-table-cell laytable-cell-1-ho_hui_num">a1</div>
												</td>
												<td data-field="ho_tb_type">
													<div class="layui-table-cell laytable-cell-1-ho_tb_type">ETH</div>
												</td>
												<td data-field="ho_js_address">
													<div class="layui-table-cell laytable-cell-1-ho_js_address">0x0cD127174cc8a05daCe4b2B17e185470b6351aD3</div>
												</td>
												<td data-field="ho_tb_jj">
													<div class="layui-table-cell laytable-cell-1-ho_tb_jj">100</div>
												</td>
												<td data-field="ho_sfmoney">
													<div class="layui-table-cell laytable-cell-1-ho_sfmoney">70</div>
												</td>
												<td data-field="ho_tk_time">
													<div class="layui-table-cell laytable-cell-1-ho_tk_time">2018-06-13 19:50:39</div>
												</td>
												<td data-field="ho_node">
													<div class="layui-table-cell laytable-cell-1-ho_node"></div>
												</td>
												<td data-field="status" data-content="1">
													<div class="layui-table-cell laytable-cell-1-status"> <label>已处理</label> </div>
												</td>
												<td data-field="8" data-content="">
													<div class="layui-table-cell laytable-cell-1-8"> </div>
												</td>
											</tr>
											<tr data-index="5" class="">
												<td data-field="ho_hui_num">
													<div class="layui-table-cell laytable-cell-1-ho_hui_num">a1</div>
												</td>
												<td data-field="ho_tb_type">
													<div class="layui-table-cell laytable-cell-1-ho_tb_type">ETH</div>
												</td>
												<td data-field="ho_js_address">
													<div class="layui-table-cell laytable-cell-1-ho_js_address">0x0cD127174cc8a05daCe4b2B17e185470b6351aD3</div>
												</td>
												<td data-field="ho_tb_jj">
													<div class="layui-table-cell laytable-cell-1-ho_tb_jj">20</div>
												</td>
												<td data-field="ho_sfmoney">
													<div class="layui-table-cell laytable-cell-1-ho_sfmoney"></div>
												</td>
												<td data-field="ho_tk_time">
													<div class="layui-table-cell laytable-cell-1-ho_tk_time">2018-06-13 19:49:16</div>
												</td>
												<td data-field="ho_node">
													<div class="layui-table-cell laytable-cell-1-ho_node">ces</div>
												</td>
												<td data-field="status" data-content="2">
													<div class="layui-table-cell laytable-cell-1-status"> <label>已退提</label> </div>
												</td>
												<td data-field="8" data-content="">
													<div class="layui-table-cell laytable-cell-1-8"> </div>
												</td>
											</tr>
											<tr data-index="6">
												<td data-field="ho_hui_num">
													<div class="layui-table-cell laytable-cell-1-ho_hui_num">CN10749032</div>
												</td>
												<td data-field="ho_tb_type">
													<div class="layui-table-cell laytable-cell-1-ho_tb_type">ETH</div>
												</td>
												<td data-field="ho_js_address">
													<div class="layui-table-cell laytable-cell-1-ho_js_address">0x0cD127174cc8a05daCe4b2B17e185470b6351aD3</div>
												</td>
												<td data-field="ho_tb_jj">
													<div class="layui-table-cell laytable-cell-1-ho_tb_jj">22</div>
												</td>
												<td data-field="ho_sfmoney">
													<div class="layui-table-cell laytable-cell-1-ho_sfmoney"></div>
												</td>
												<td data-field="ho_tk_time">
													<div class="layui-table-cell laytable-cell-1-ho_tk_time">2018-06-13 01:19:00</div>
												</td>
												<td data-field="ho_node">
													<div class="layui-table-cell laytable-cell-1-ho_node">xx测试退回</div>
												</td>
												<td data-field="status" data-content="2">
													<div class="layui-table-cell laytable-cell-1-status"> <label>已退提</label> </div>
												</td>
												<td data-field="8" data-content="">
													<div class="layui-table-cell laytable-cell-1-8"> </div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="layui-table-page">
								<div id="layui-table-page1">
									<div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
										<a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0"><i class="layui-icon"></i></a><span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>1</em></span>
										<a href="javascript:;" class="layui-laypage-next layui-disabled" data-page="2"><i class="layui-icon"></i></a><span class="layui-laypage-skip">到第<input type="text" min="1" value="1" class="layui-input">页<button type="button" class="layui-laypage-btn">确定</button></span><span class="layui-laypage-count">共 7 条</span><span class="layui-laypage-limits"><select lay-ignore=""><option value="10" selected="">10 条/页</option><option value="20">20 条/页</option><option value="30">30 条/页</option><option value="40">40 条/页</option><option value="50">50 条/页</option><option value="60">60 条/页</option><option value="70">70 条/页</option><option value="80">80 条/页</option><option value="90">90 条/页</option></select></span></div>
								</div>
							</div>
							<style>
								.laytable-cell-1-ho_hui_num {
									width: 204px;
								}
								
								.laytable-cell-1-ho_tb_type {
									width: 204px;
								}
								
								.laytable-cell-1-ho_js_address {
									width: 204px;
								}
								
								.laytable-cell-1-ho_tb_jj {
									width: 204px;
								}
								
								.laytable-cell-1-ho_sfmoney {
									width: 204px;
								}
								
								.laytable-cell-1-ho_tk_time {
									width: 204px;
								}
								
								.laytable-cell-1-ho_node {
									width: 204px;
								}
								
								.laytable-cell-1-status {
									width: 204px;
								}
								
								.laytable-cell-1-8 {
									width: 204px;
								}
							</style>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		
		<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
		<script>
			var thid;
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

				//监听工具条
				table.on('tool(tablelist)', function(obj) {
					var data = obj.data;
					if(obj.event === 'detailsjx') {
						layer.confirm('您确定要处理此次会员提币申请吗？', function(index) {
							$.post('/admin/updatetmoney', {
									id: data.id,
									huinumber: data.ho_hui_num
								},
								function(obj) {
									if(obj.Status == 'ok') {
										layer.msg('处理成功');
										initsjx();
									} else {
										layer.msg(obj.Erro);
									}
								});
						});
					} else if(obj.event === 'delsjx') {
						layer.confirm('确定要提到E链数字信誉托管平台吗？', function(index) {
							//删除收件箱消息
							$.ajax({
								type: "POST",
								async: false,
								dataType: "json",
								url: "/admin/tbelian",
								data: {
									id: data.id,
									huinumber: data.ho_hui_num
								},
								success: function(data) {
									if(data.Status == 'ok') {
										layer.msg('提币成功');
										initsjx();
									} else {
										layer.msg(data.Erro);
									}
								},
								error: function(data) {
									alert("网络错误");
								}
							});
							layer.close(index);
						});
					} else if(obj.event === 'tuijsjx') {
						layer.confirm('确定要退提吗？', function(index) {
							thid = data.id;
							//多窗口模式，层叠置顶
							addLaer = layer.open({
								type: 2 //此处以iframe举例
									,
								title: '填写退回原因',
								area: ['80%', '80%'],
								shade: 0,
								content: '/admin/cannalyy.html',
								yes: function() {
									$(that).click();
								},
								btn2: function() {
									layer.closeAll();
								},
								zIndex: layer.zIndex //重点1
									,
								success: function(layero) {}
							});
							return false;
						});
					}
				});

				window.getyy = function(yy) {
					$.ajax({
						type: "POST",
						async: false,
						dataType: "json",
						url: "/admin/tuijupdate",
						data: {
							yy: yy,
							id: thid
						},
						success: function(data) {
							if(data.Status == 'ok') {
								layer.msg('退提成功');
								layer.closeAll();
								initsjx();
							} else {
								layer.msg('操作失败');
							}
						},
						error: function(data) {
							alert("网络错误");
						}
					});
					layer.close(index);
				}

				window.closeadd = function() {
					layer.closeAll();
					initsjx();
				}

				window.initsjx = function() {
					table.render({
						elem: '#sjxtablelist',
						url: '/admin/huitmoneylist?acc=' + $("#acc").val() + "&start=" + $("#date").val() + "&end=" + $("#date1").val(),
						cols: [
							[{
									field: 'ho_hui_num',
									title: '会员编号'
								}, {
									field: 'ho_tb_type',
									title: '提币种类'
								}, {
									field: 'ho_js_address',
									title: '接收地址'
								}, {
									field: 'ho_tb_jj',
									title: '提币奖金'
								}, {
									field: 'ho_sfmoney',
									title: '实发金额'
								}
								/*  ,{field:'ho_jf',title: '积分'} */
								, {
									field: 'ho_tk_time',
									title: '提款时间'
								}, {
									field: 'ho_node',
									title: '退回原因'
								}, {
									field: 'status',
									title: '状态',
									templet: '#msgstatus'
								}, {
									field: '',
									title: '操作',
									templet: '#barmsg'
								}
							]
						],
						page: true
					});
				}

				initsjx();
			});
		</script>
		<script type="text/html" id="barmsg">
			
			<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">处理</a>
			<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="tuijsjx">退提</a>
			<a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="delsjx">提E链</a>
		</script>
		<script id="msgstatus" type="text/html">
			<label></label>
		</script>
	</body>

</html>
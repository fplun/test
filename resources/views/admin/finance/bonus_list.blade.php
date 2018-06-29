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
             <legend>总拨出</legend>
			  <div class="layui-field-box">
			     <table id="tableall" lay-filter="tableall"></table><div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-2" style=" "><div class="layui-table-box"><div class="layui-table-header"><table cellspacing="0" cellpadding="0" border="0" class="layui-table"><thead><tr><th data-field="hb_jjffze"><div class="layui-table-cell laytable-cell-2-hb_jjffze"><span>奖金发放总额</span></div></th><th data-field="hb_dcyj"><div class="layui-table-cell laytable-cell-2-hb_dcyj"><span>总业绩</span></div></th><th data-field="hb_fpbl"><div class="layui-table-cell laytable-cell-2-hb_fpbl"><span>分配比率</span></div></th></tr></thead></table></div><div class="layui-table-body layui-table-main"><table cellspacing="0" cellpadding="0" border="0" class="layui-table"><tbody><tr data-index="0"><td data-field="hb_jjffze"><div class="layui-table-cell laytable-cell-2-hb_jjffze">0</div></td><td data-field="hb_dcyj"><div class="layui-table-cell laytable-cell-2-hb_dcyj">0</div></td><td data-field="hb_fpbl"><div class="layui-table-cell laytable-cell-2-hb_fpbl">0%</div></td></tr></tbody></table></div></div><style>.laytable-cell-2-hb_jjffze{ width: 397px; }.laytable-cell-2-hb_dcyj{ width: 397px; }.laytable-cell-2-hb_fpbl{ width: 397px; }</style></div>
			  </div>
         </fieldset>
          <fieldset class="layui-elem-field">
             <legend>拨出率统计</legend>
			  <div class="layui-field-box">
			     <table id="sjxtablelist" lay-filter="tablelist"></table><div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-1" style=" "><div class="layui-table-box"><div class="layui-table-header"><table cellspacing="0" cellpadding="0" border="0" class="layui-table"><thead><tr><th data-field="hb_jjffze"><div class="layui-table-cell laytable-cell-1-hb_jjffze"><span>奖金发放总额</span></div></th><th data-field="hb_dcyj"><div class="layui-table-cell laytable-cell-1-hb_dcyj"><span>当次业绩</span></div></th><th data-field="hb_fpbl"><div class="layui-table-cell laytable-cell-1-hb_fpbl"><span>分配比率</span></div></th><th data-field="creattime"><div class="layui-table-cell laytable-cell-1-creattime"><span>结算日期</span></div></th></tr></thead></table></div><div class="layui-table-body layui-table-main"><table cellspacing="0" cellpadding="0" border="0" class="layui-table"><tbody></tbody></table><div class="layui-none">无数据</div></div></div><div class="layui-table-page layui-hide"><div id="layui-table-page1"></div></div><style>.laytable-cell-1-hb_jjffze{ width: 297px; }.laytable-cell-1-hb_dcyj{ width: 297px; }.laytable-cell-1-hb_fpbl{ width: 297px; }.laytable-cell-1-creattime{ width: 297px; }</style></div>
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
				    initall();
					initsjx();
			 }  
			 
	       window.initall =  function(){
				table.render({
					elem: '#tableall'
					,url:'/admin/bcltjlisttotal'
					,cols: [[
						 {field:'hb_jjffze', title: '奖金发放总额'}
						 ,{field:'hb_dcyj',title: '总业绩'}
						 ,{field:'hb_fpbl',title: '分配比率'} 
					]]
					,page: false
				});
			}
	       
			window.initsjx =  function(){
				table.render({
					elem: '#sjxtablelist'
					,url:'/admin/bcltjlist'
					,cols: [[
						 {field:'hb_jjffze', title: '奖金发放总额'}
						 ,{field:'hb_dcyj',title: '当次业绩'}
						 ,{field:'hb_fpbl',title: '分配比率'}
						 ,{field:'creattime',title: '结算日期'}
					]]
					,page: true
				});
			}
			
			initsjx();
			initall();
		});
	</script>
		 <script type="text/html" id="barmsg">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">会员资料修改</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">登录会员界面</a>
       </script>
       	 <script id="msgstatus" type="text/html">
		<label ></label>
	</script>
</body></html>
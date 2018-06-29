<html><head>
  <meta charset="utf-8">
  <title>新闻公告管理</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
	<script src="/layui/js/jquery-1.10.2.min.js"></script>
	<script src="/layui/layui-v2.2.5/layui/layui.js"></script>
<script type="text/javascript" src="/layui/js/settimeqt.js"></script>
<link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
<body layadmin-themealias="green">

  <div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
          <fieldset class="layui-elem-field">
             <legend>新闻公告管理</legend>
  <div class="layui-field-box">
		              <button class="layui-btn layui-btn-primary layui-btn-sm" style="margin-bottom: 10px;" id="addnewbtn">添加新闻</button> 
               <table id="sjxtablelist" lay-filter="tablelist"></table><div class="layui-form layui-border-box layui-table-view" lay-filter="LAY-table-1" style=" "><div class="layui-table-box"><div class="layui-table-header"><table cellspacing="0" cellpadding="0" border="0" class="layui-table"><thead><tr><th data-field="title"><div class="layui-table-cell laytable-cell-1-title"><span>公告标题</span></div></th><th data-field="date"><div class="layui-table-cell laytable-cell-1-date"><span>发布时间</span></div></th><th data-field="2"><div class="layui-table-cell laytable-cell-1-2"><span>操作</span></div></th></tr></thead></table></div><div class="layui-table-body layui-table-main"><table cellspacing="0" cellpadding="0" border="0" class="layui-table"><tbody></tbody></table><div class="layui-none">无数据</div></div></div><div class="layui-table-page layui-hide"><div id="layui-table-page1"></div></div><style>.laytable-cell-1-title{ width: 616px; }.laytable-cell-1-date{ width: 616px; }.laytable-cell-1-2{ width: 616px; }</style></div>
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
			   $('#addnewbtn').on('click', function(){
		            //多窗口模式，层叠置顶
		           addLaer= layer.open({
		                type: 2 //此处以iframe举例
		                ,title: '新闻公告添加'
		                ,area: ['50%', '70%']
		                ,shade: 0
		                ,content: '/admin/toaddnews'
		                //,btn: ['继续弹出', '全部关闭'] //只是为了演示
		                ,yes: function(){
		                    $(that).click();
		                }
		                ,btn2: function(){
		                    layer.closeAll();
		                }
		                ,zIndex: layer.zIndex //重点1
		                ,success: function(layero){
		                    layer.setTop(layero); //重点2
		                }
		            });
		        });
			   
			 //监听工具条
			  table.on('tool(tablelist)', function(obj){
			    var data = obj.data;
			    if(obj.event === 'detailsjx'){
			      //layer.msg('ID：'+ data.id + ' 的查看操作');
			    	addLaer=layer.open({
		                type: 2 //此处以iframe举例
		                ,title: data.nb_title
		                ,area: ['50%', '70%']
		                ,shade: 0
		                ,content: '/admin/news_edit?id='+data.id
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
			    	layer.confirm('确定要删除该条消息?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/news_delete",
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
				//发件箱
				table.render({
					elem: '#sjxtablelist'
					,url:'/admin/get_news'
					,cols: [[
						 {field:'title', title: '公告标题'}
						 ,{field:'created_at',title: '发布时间'}
		                    ,{field:'', title: '操作', sort: false, templet: '#barmsg'}
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>
		 <script type="text/html" id="barmsg">
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">删除</a>
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">编辑</a>
       </script>

</body></html>


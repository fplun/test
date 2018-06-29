@extends('user._layout')
@section('content')
    <link rel="stylesheet" href="/user/layui/css/layuiextend.css">
    <div class="content-wrapper">
        <h3>{{__('公告')}}</h3>
        <div class="panel panel-default">
            <table class="table table-hover"  id="sjxtablelist" lay-filter="tablelist">
            </table>
        </div>
        
    </div>
    <script type="text/javascript" src="/user/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript" src="/user/layui/layui.js"></script>
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
		                ,content: '/admin/tolooknews?id='+data.id
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
	                        url: "/admin/delhynotice",
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
					elem: '#sjxtablelist',
					url:'/news',
					cols: [[
                        {field:'title', title: "{{__('公告标题')}}", templet: '#titlebar'},
                        {field:'created_at',title: "{{__('发布时间')}}"}
		                /*     ,{field:'', title: '操作', sort: false, templet: '#barmsg'} */
                    ]],
					page: true
				});
			}
			
			initsjx();
		});
	</script>
	<script id="titlebar" type="text/html">
		 <a href="/newsDetail?id=@{{d.id}}"> @{{d.title}}</a>
	</script>
@endsection
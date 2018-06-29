@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{__('转账记录')}}</h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="sjxtablelist" lay-filter="tablelist"></table>
            </div>
        </div>
    </div>
</div>

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
		                ,content: '/admin/toupdatehui?id='+data.id
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
					,url:'/get_transferlist'
					,cols: [[
						 {field:'sell_username',title: "{{__('转出用户')}}"}
						 ,{field:'buy_username',title: "{{__('转入用户')}}"}
						 ,{field:'money', title: "{{__('金额')}}"}
						 ,{field:'type', title: "{{__('类型')}}",templet: '#type'}
						 ,{field:'created_at', title: "{{__('时间')}}"}
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>

	<script type="text/html" id="type">
               @{{ d.type == 0? '激活币':'注册币'}}
       </script>


		 <script type="text/html" id="barmsg">
                <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">会员资料修改</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">登录会员界面</a>
       </script>
@endsection
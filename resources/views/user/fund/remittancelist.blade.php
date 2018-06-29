@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <div class="content-wrapper">
        <h3>{{__('充值记录')}}</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover"   id="sjxtablelist" lay-filter="tablelist">
                    </table>
                </div>
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
			    	 layer.confirm('您确定要不通过吗？', function(index){
	  			          $.post('/admin/updateczstatus',
	  			             {
	  		                            id:data.id,
	  		                            status:2
	  		                        },
	  			   	    		function(obj){
	  			   	    	          if(obj.Status=='ok'){
	  			   	    	        	layer.msg('处理成功');
	  			   	    	   	initsjx();
	  			   	    	       initsjx();
	  			   	    	          }else{
	  			   	    	        	layer.msg(obj.Erro); 
	  			   	    	          }
	  		            	});	 
	  				 });  
			    } else if(obj.event === 'delsjx'){
			    	layer.confirm('确定要通过?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/admin/updateczstatus",
	                        data:{
	                            id:data.id,
		                            status:1
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                                layer.msg('处理成功');
	                            	initsjx();
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
			    }  else if(obj.event === 'tuyl'){
			    	addLaer=layer.open({
		                type: 1 //此处以iframe举例
		                ,title: '预览'
		                ,area: ['90%', '90%']
		                ,shade: 0
		                ,content: '<img  style=cursor:pointer  src='+data.voucher+' />'
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
			    }  
			  });
			
	       window.closeadd = function(){
				    layer.closeAll();
					initsjx();
			 }  
			 
			window.initsjx =  function(){
				table.render({
					elem: '#sjxtablelist'
					,url:'/rechargeListJson'
					,cols: [[
						/*  {field:'hp_hui_num', title: '会员编号'} */
						 {field:'money',title: "{{__('充值金额')}}"}
						 ,{field:'voucher',title: "{{__('汇款凭证')}}", templet: '#tupbar'}
						 ,{field:'updated_at',title: "{{__('确认时间')}}"}
						 ,{field:'no_pass',title: "{{__('退回原因')}}"}
						 ,{field:'status',title: "{{__('状态')}}", templet: '#msgstatus'}
					/* 	 ,{field:'',title: '操作', templet: '#barmsg'} */
					]]
					,page: true
				});
			}
			
			initsjx();
		});
	</script>
		 <script type="text/html" id="barmsg">
              <a class="layui-btn  layui-btn-xs" lay-event="delsjx">通过</a>
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">不通过</a>
       </script>
        <script id="tupbar" type="text/html">
		      <label ><img title="点我预览"  style="cursor:pointer"  src="@{{ d.voucher }}"  lay-event="tuyl" /></label>
	</script>
        	 <script id="msgstatus" type="text/html">
		<label >@{{ d.state== 0 ? '未处理' :d.state== 1 ? '审核通过' : '<font style="color:red">未通过</font>'  }}</label>
	</script>
@endsection
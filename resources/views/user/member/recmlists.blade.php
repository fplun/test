@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{__('我的推荐')}}</h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" lay-filter="tablelist"  id="sjxtablelist">
                </table>
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
            }  else if(obj.event === 'delete_no_open'){
			    	layer.confirm('确定要删除?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/delete_no_open",
	                        data:{
	                            id:data.id
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                            	obj.del();
	                                layer.msg('删除成功');
	                            }else{
	                                layer.msg(data.Erro);
	                            }
	                        },
	                        error: function(data) {
	                            alert("网络错误");
	                        }
	                    });
	                    layer.close(index);
	                  });
			    }  else if(obj.event === 'jihuo'){
			    	layer.confirm('确定要激活?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/jihuo_no_open",
	                        data:{
	                            id:data.id
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                            	obj.del();
	                                layer.msg('激活成功');
	                            }else{
	                                layer.msg(data.Erro);
	                            }
	                        },
	                        error: function(data) {
	                            alert("网络错误");
	                        }
	                    });
	                    layer.close(index);
	                  });
			    }  else if(obj.event === 'register'){
			    	layer.confirm('确定要激活?', function(index){
	                    //删除收件箱消息
	                    $.ajax({
	                        type: "POST",
	                        async:false,
	                        dataType: "json",
	                        url: "/jihuo_no_open",
	                        data:{
	                            id:data.id,
                                state:1
	                        },
	                        success: function (data) {
	                            if(data.Status=='ok'){
	                            	obj.del();
	                                layer.msg('激活成功');
	                            }else{
	                                layer.msg(data.Erro);
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
            table.render({
                elem: '#sjxtablelist'
                ,url:'/recommendListJson'
                ,cols: [[
                        {field:'username', title: "{{__('会员编号')}}"}
                        ,{field:'name',title: "{{__('会员姓名')}}"}
                        // ,{field:'hui_level',title: '会员级别', templet: '#level'}
                        ,{field:'register_money',title: "{{__('会员投资')}}"}
                        // ,{value:'hui_tjr_num',title: '推荐人'}
                        ,{field:'created_at',title: "{{__('注册日期')}}"}
                        /* ,{field:'state',title: '状态', templet: '#msgstatus'} */
                      ,{field:'', title: "{{__('激活+注册')}}", sort: false, templet: '#barmsg'} 
                      ,{field:'', title: "{{__('激活')}}", sort: false, templet: '#register'} 
                      ,{field:'', title: "{{__('删除')}}", sort: false, templet: '#barmsg2'} 
                ]]
                ,page: true
            });
        }
        
        initsjx();
    });
</script>
<script type="text/html" id="barmsg">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="jihuo">{{__('激活+注册')}}</a>
</script>
<script type="text/html" id="register">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="register">{{__('激活')}}</a>
</script>

<script type="text/html" id="barmsg2">
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delete_no_open">{{__('删除')}}</a>
</script>
<script id="msgstatus" type="text/html">
    <label >@{{ d.state == 1 ? '已开通' : (d.status == 0 ? '未开通' : '已冻结')}}</label>
</script>
<script id="level" type="text/html">
    <label >@{{ d.hui_level}}美金</label>
</script>
@endsection
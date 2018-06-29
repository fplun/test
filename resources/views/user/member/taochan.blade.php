@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>{{__('配套管理')}}</h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover"   id="sjxtablelist" lay-filter="tablelist">
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
                layer.confirm('确定要解锁吗?', function(index){
                    $.ajax({
                        type: "POST",
                        async:false,
                        dataType: "json",
                        url: "/release_lock",
                        data:{
                            id:data.id
                        },
                        success: function (data) {
                            if(data.Status=='ok'){
                                layer.msg('解锁成功');
                                initsjx();
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
                ,url:'/get_taochan?'
                ,cols: [[
                        {field:'money',title: "{{__('投资金额')}}"}
                        ,{field:'zyl_num',title: "{{__('锁仓数量')}}"}
                        ,{field:'created_at',title: "{{__('投资时间')}}"}
                        ,{field:'last_day',title: "{{__('剩余锁仓天数')}}"}
                        ,{field:'price',title: "{{__('众易链价格')}}"}
                        ,{field:'release_money',title: "{{__('已释放数量')}}"}
                        ,{field:'state',title: "{{__('状态')}}"}
                /* 	 ,{field:'tc_sz',title: '上涨'} */
                        ,{field:'', title: "{{__('操作')}}", sort: false, templet: '#barmsg'}  
                ]]
                ,page: true
            });
        }
        
        initsjx();
    });
</script>
<script type="text/html" id="barmsg">
        @{{ d.release_state== 1 ? '<a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">解锁</a>' :'' }}  
</script>
<script id="msgstatus" type="text/html">
    <label >@{{ d.status== 0 ? '未读' :'已读' }}</label>
</script>
@endsection
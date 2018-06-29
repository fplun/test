@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <h3>会员审核</h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover"   id="sjxtablelist">
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
                    layer.confirm('您确定要确认吗？', function(index){
                        $.post('/updatehuiuserinfo',
                            {
                                    id:data.id
                                    ,cunum:'a4'
                                },
                            function(obj){
                                    if(obj.Status=='ok'){
                                    layer.msg('确认成功');
                                initsjx();
                                    }else{
                                    layer.msg(obj.Erro); 
                                    }
                        });	 
                    });  
            } else if(obj.event === 'delsjx'){
                layer.confirm('确定要删除?', function(index){
                    //删除收件箱消息
                    $.ajax({
                        type: "POST",
                        async:false,
                        dataType: "json",
                        url: "/delhyuserinfo",
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
            table.render({
                elem: '#sjxtablelist'
                ,url:'/recommendListJson'
                ,cols: [[
                        {field:'username', title: '会员编号'}
                        ,{field:'name',title: '会员姓名'}
                        // ,{field:'hui_level',title: '会员级别', templet: '#level'}
                        ,{field:'money',title: '会员投资'}
                        // ,{value:'hui_tjr_num',title: '推荐人'}
                        ,{field:'created_at',title: '注册日期'}
                        ,{field:'hui_is_open',title: '操作', templet: '#barmsg'}
                /*      ,{field:'', title: '操作', sort: false, templet: '#barmsg'} */
                ]]
                ,page: true
            });
        }
        
        initsjx();
    });
</script>
        <script type="text/html" id="barmsg">
            <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="detailsjx">确认</a>
            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">删除</a>
    </script>
        <script id="msgstatus" type="text/html">
    <label >@{{ d.hui_is_open== 0 ? '未开通' :'已开通' }}</label>
</script>
    <script id="level" type="text/html">
    <label >@{{ d.hui_level}}美金</label>
</script>
@endsection
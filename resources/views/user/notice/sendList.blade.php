@extends('user._layout')
@section('content')
<div class="content-wrapper">
    <div class="content-wrapper">
        <h3>{{__('发件箱')}}</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table  table-hover"  id="fjxtablelist" lay-filter="tablelist">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element'],
    function() {
        var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form,
        table = layui.table,
        element = layui.element,
        upload = layui.upload;

        element.on('tab(msgtab)', function(data) {
            // console.log(this); //当前Tab标题所在的原始DOM元素
            //console.log(data.index); //得到当前Tab的所在下标
            // console.log(data.elem); //得到当前的Tab大容器
            if (data.index == 0) {
                initsjx();
            } else if (data.index == 1) {
                initfjx();
            }
        });

        //监听提交(发送消息)
        form.on('submit(msgsubmit)',
        function(data) {
            /*    layer.alert(JSON.stringify(data.field), {
			               title: '最终的提交信息'
			        })    */

            var backnum = data.field.backnum;
            $.post('/admin/validbacknum', {
                backnum: backnum
            },
            //这个是表单序列化值
            function(obj) {
                if (obj.Status == 'ok') {
                    //对话框
                    layer.confirm('您确定要发送吗？',
                    function(index) {
                        //发送请求  admin 指向后台 sendmsg 后台方法
                        $.post('/admin/sendmsg', data.field, //这个是表单序列化值
                        function(obj) {
                            if (obj.Status == 'ok') {
                                layer.msg('发送成功');
                            } else {
                                layer.msg('发送失败');
                            }
                        });
                    });
                } else {
                    layer.msg('没有接收该会员编号!');
                }
            });
            return false;
        });
        var addLaer;
        //监听工具条
        table.on('tool(tablelist)',
        function(obj) {
            var data = obj.data;
            if (obj.event === 'detailsjx') {
                //layer.msg('ID：'+ data.id + ' 的查看操作');
                addLaer = layer.open({
                    type: 2 //此处以iframe举例
                    ,
                    title: data.nb_title,
                    area: ['50%', '50%'],
                    shade: 0,
                    content: '/noticeDetail?id=' + data.id,
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
            } else if (obj.event === 'delsjx') {
                layer.confirm('确定要删除该条消息?',
                function(index) {
                    //删除收件箱消息
                    $.ajax({
                        type: "POST",
                        async: false,
                        dataType: "json",
                        url: "/delNotice",
                        data: {
                            id: data.id
                        },
                        success: function(data) {
                            if (data.Status == 'ok') {
                                obj.del();
                                layer.msg('删除成功');
                            } else {
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

        initfjx();
        function initfjx() {
            //发件箱
            table.render({
                elem: '#fjxtablelist',
                url: '/sendListJson',
                cols: [[{
                    field: 'title',
                    title: "{{__('邮件标题')}}"
                },
                {
                    field: 'created_at',
                    title: "{{__('发送时间')}}"
                }
                /*   ,{field:'status', title: '查看状态', templet: '#msgstatus'} */
                , {
                    field: '',
                    title: "{{__('操作')}}",
                    sort: false,
                    templet: '#barmsg'
                }]],
                page: true
            });
        }

        initsjx();
        function initsjx() {
            //发件箱
            table.render({
                elem: '#sjxtablelist',
                url: '/sendListJson',
                cols: [[{
                    field: 'senduserinfo',
                    title: "{{__('发件人信息')}}"
                },
                {
                    field: 'creattime',
                    title: "{{__('发件人时间')}}"
                },
                {
                    field: 'status',
                    title: "{{__('查看状态')}}",
                    templet: '#msgstatus'
                },
                {
                    field: '',
                    title: "{{__('操作')}}",
                    sort: false,
                    templet: '#barmsg'
                }]],
                page: true
            });
        }
    });
</script>
<script type="text/html" id="barmsg">
    <a class = "layui-btn layui-btn-primary layui-btn-xs" lay-event = "detailsjx"> "{{__('查看')}}" </a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="delsjx">"{{__('删除')}}"</a>
</script>
<script id="msgstatus" type="text/html">
    <label> 
        @{{ d.status == 0 ? '未读': '已读' }}
    </label>
</script>
@endsection
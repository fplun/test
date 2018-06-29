<!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <title>消息中心</title> 
  <meta name="renderer" content="webkit" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" /> 
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all" /> 
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all" /> 
  <link id="layuicss-layer" rel="stylesheet" href="http://www.layui.com/admin/std/dist/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all" />
  {{-- <script type="text/javascript" src="js/settimeqt.js"></script> --}}
 </head> 
 <body layadmin-themealias="green"> 
  <div class="layui-fluid" id="LAY-app-message"> 
   <div class="layui-card"> 
    <div class="LAY-app-message-btns" style="margin-bottom: 10px;"> 
     <form class="layui-form layui-form-pane" action=""> 
      <div class="layui-form-item"> 
       <label class="layui-form-label">发件人编号</label> 
       <div class="layui-input-inline"> 
        <input type="text" name="sendnum" lay-verify="required" readonly="readonly" value="{{ $notice->send_user }}" placeholder="请输入" autocomplete="off" class="layui-input" /> 
       </div> 
      </div> 
      <div class="layui-form-item"> 
       <label class="layui-form-label">收件人编号</label> 
       <div class="layui-input-inline"> 
        <input readonly="readonly" value="{{ $notice->receive_user }}" type="text" name="backnum" lay-verify="required" placeholder="请输入收件人编号" autocomplete="off" class="layui-input" /> 
       </div> 
      </div> 
      <div class="layui-form-item"> 
       <label class="layui-form-label">消息标题</label> 
       <div class="layui-input-block"> 
        <input type="text" name="title" readonly="readonly" value="{{ $notice->title }}" autocomplete="off" lay-verify="required" placeholder="请输入消息标题" class="layui-input" /> 
       </div> 
      </div> 
      <div class="layui-form-item layui-form-text"> 
       <label class="layui-form-label">消息内容</label> 
       <div class="layui-input-block"> 
        <textarea placeholder="请输入消息内容" readonly="readonly" lay-verify="required" name="content" class="layui-textarea"> {{ $notice->content }} </textarea> 
       </div> 
      </div> 
     </form> 
    </div> 
   </div> 
  </div>
 </body>
</html>
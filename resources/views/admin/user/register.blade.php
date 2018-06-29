<!-- <form action="/admin/register_make" method="post" >
		{{ csrf_field() }}
会员编号<input type="text" name="username" value="asdfassaa">
<br/>
一级密码<input type="text" name="password" value="111111">
<br/>
二级密码<input type="text" name="sec_password" value="222222">
<br/>
会员姓名<input type="text" name="name" value="asdfass">
<br/>
手机号<input type="num" name="phone" value="15738849971">
<br/>
邮箱<input type="email" name="email" value="825096218@qq.com">
<br/>

<input type="submit">
</form>



@if (count($errors) > 0)
        {{ $errors->first() }}
 @endif -->


<html><head>
  <meta charset="utf-8">
  <title>会员注册</title>
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
				    <div class="layui-field-box">
						               <form class="layui-form layui-form-pane" action="">
						                         <fieldset class="layui-elem-field">
													             <legend>会员登录信息</legend>
													  <div class="layui-field-box">
															                <div class="layui-form-item">
																			    <label class="layui-form-label">会员编号</label>
																			    <div class="layui-input-block">
																			      <input type="text" name="username" value="{{$username}}" autocomplete="off" lay-verify="huiNumber" placeholder="请输入会员编号" class="layui-input">
																			    </div>
																			  </div>
																			    <div class="layui-form-item">
																			    <label class="layui-form-label">一级密码</label>
																			    <div class="layui-input-block">
																			      <input type="text" name="password" autocomplete="off" lay-verify="required" value="111111" placeholder="请输入一级密码" class="layui-input">
																			    </div>
																			  </div>
																			    <div class="layui-form-item">
																			    <label class="layui-form-label">二级密码</label>
																			    <div class="layui-input-block">
																			      <input type="text" name="sec_password" autocomplete="off" lay-verify="required" value="222222" placeholder="请输入二级密码" class="layui-input">
																			    </div>
																			  </div>
													  </div>
													</fieldset>
													
													<fieldset class="layui-elem-field">
													             <legend>会员脉络信息</legend>
													  <div class="layui-field-box">
																			    <div class="layui-form-item">
																			    <label class="layui-form-label">投资额度</label>
																			    <div class="layui-input-block">
																			       <div class="layui-input-inline">
																				       <input type="text" value="" name="money" autocomplete="off" lay-verify="huiLevel" placeholder="投资额度为100的倍数" class="layui-input">
																				    </div>
																			    </div>
																			  </div>
																			    <div class="layui-form-item">
																			    <label class="layui-form-label">推荐人编号</label>
																			    <div class="layui-input-block">
																			      <input type="text" value="" name="recommend" autocomplete="off"  placeholder="不输入则为顶级账号" class="layui-input">
																			    </div>
																			  </div>  
																			    <div class="layui-form-item">
																			    <label class="layui-form-label">接点人编号</label>
																			    <div class="layui-input-block">
																			      <input type="text" value="" name="contact" autocomplete="off" placeholder="不输入则为顶级账号" class="layui-input">
																			    </div>
																			  </div>
																			  <div class="layui-form-item">
																			    <label class="layui-form-label">位置</label>
																			    <div class="layui-input-block">
																			       <div class="layui-input-inline">
																				      <select name="position" lay-verify="required">
																								        <option value="1" {{ $position==1 ? 'selected' : '' }}>A区</option>
																								        <option value="2" {{ $position==2 ? 'selected' : '' }}>B区</option>
																								      </select><div class="layui-unselect layui-form-select"><div class="layui-select-title"><input type="text" placeholder="请选择" value="A区" readonly="" class="layui-input layui-unselect"><i class="layui-edge"></i></div><dl class="layui-anim layui-anim-upbit"><dd lay-value="1" class="layui-this">A区</dd><dd lay-value="2" class="">B区</dd></dl></div>
																				    </div>
																			    </div>
																			  </div>  
													  </div>
													</fieldset>
													<fieldset class="layui-elem-field">
													             <legend>会员基本信息</legend>
													  <div class="layui-field-box">
															               <!--  <div class="layui-form-item">
																			    <label class="layui-form-label">会员姓名</label>
																			    <div class="layui-input-block">
																			      <input type="text" value="" name="name" autocomplete="off" lay-verify="required" placeholder="请输入会员姓名" class="layui-input">
																			    </div>
																			  </div> -->
																			    <!-- <div class="layui-form-item">
																			    <label class="layui-form-label">会员手机</label>
																			    <div class="layui-input-block">
																			      <input type="text" value="15738849971" name="phone" autocomplete="off" lay-verify="huiPhone" placeholder="请输入会员手机" class="layui-input">
																			    </div>
																			  </div> -->
																			   <div class="layui-form-item">
																			    <label class="layui-form-label">会员邮箱</label>
																			    <div class="layui-input-block">
																			      <input type="text" value="" name="email" autocomplete="off" lay-verify="huiEmail" placeholder="请输入会员邮箱" class="layui-input">
																			    </div>
																			  </div>
													  </div>
													</fieldset>
													<!-- <fieldset class="layui-elem-field">
													             <legend>会员帐号信息</legend>
													  <div class="layui-field-box">
															                <div class="layui-form-item">
																			    <label class="layui-form-label">提币种类</label>
																			    <div class="layui-input-block">
																			      <input type="text" value="ETH" name="extract_type" autocomplete="off" lay-verify="required" placeholder="请输入提币种类" class="layui-input">
																			    </div>
																			  </div>
																			    <div class="layui-form-item">
																			    <label class="layui-form-label">接收地址</label>
																			    <div class="layui-input-block">
																			      <input type="text" value="1asdfgasg" name="extract_address" autocomplete="off" lay-verify="required" placeholder="请输入接收地址" class="layui-input">
																			    </div>
																			  </div>
													  </div>
													</fieldset> -->
														  <div class="layui-form-item">
														    <button class="layui-btn" lay-submit="" lay-filter="huiregsubmit">确认提交</button>
														  </div>
														</form>
				  </div>
        </div>
      </div>
	<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
	<script>
		layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element', 'layedit'], function(){
			var $ = layui.jquery
					, layer = layui.layer //独立版的layer无需执行这一句
					,form = layui.form
					,table = layui.table//数据表格
			,element = layui.element
			,layedit = layui.layedit
			 ,upload = layui.upload;
			
			//自定义验证规则  
			  form.verify({  
				 huiNumber: [/^[A-Za-z0-9]+$/, '会员编号只能输入字母或数字！']
			     ,huiTjrNum: [/^[A-Za-z0-9]+$/, '推荐人编号只能输入字母或数字！']
			   ,huiLevel: [/^[0-9]+$/, '投资额度只能输入数字！']
			     ,huiJdrNum: [/^[A-Za-z0-9]+$/, '接点人编号只能输入字母或数字！']
			     ,huiPhone: [/^1[3|4|5|7|8]\d{9}$/, '手机必须11位，只能是数字！']   
			  ,huiEmail: [/[a-zA-Z0-9]{1,10}@[a-zA-Z0-9]{1,5}\.[a-zA-Z0-9]{1,5}/, '邮箱格式不正确！']   
			  });  
			
			 //监听提交(发送消息)
			  form.on('submit(huiregsubmit)', function(data){
				/*             layer.alert(JSON.stringify(data.field), {
	               title: '最终的提交信息'
	        })    */
				   //对话框
	  			   	  layer.confirm('您确定要提交吗？', function(index){
	  			   		 //发送请求  admin 指向后台 sendmsg 后台方法
	  			          $.post('/admin/register_make',
	  			   	    		data.field,//这个是表单序列化值
	  			   	    		function(obj){
	  			   	    	          if(obj.Status=='ok'){
	  			   	    	        	layer.msg('提交成功,请移至未激活会员管理,进行会员再次确认通过！');
	  			   	    	          }else{
	  			   	    	        	layer.msg(obj.Erro);//该市场位置上已经有人，请重新选择市场位置！
	  			   	    	          }
	  		            	});	 
	  				 });  
			    return false;
			  });		 
		});
	</script>
</body></html>
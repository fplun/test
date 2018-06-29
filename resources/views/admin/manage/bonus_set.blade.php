<html><head>
  <meta charset="utf-8">
  <title>消息中心</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
   <script src="/layui/js/jquery-1.10.2.min.js"></script>
	<script src="/layui/js/settime.js"></script>
	<script src="/layui/layui-v2.2.5/layui/layui.js"></script>
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all"><script type="text/javascript" src="/layui/js/settimeqt.js"></script><link id="layuicss-laydate" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/laydate/default/laydate.css?v=5.0.9" media="all"></head>
<body layadmin-themealias="green" style="">
<div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
				    <div class="layui-field-box">
				    
				    
				    
 
<form class="layui-form" action="">
 

    <input type="hidden" name="id" value="1">
   
   <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>众易链价格</legend>
</fieldset>
  <div class="layui-form-item">
    <label class="layui-form-label">众易链价格</label>
    <div class="layui-input-inline">
      <input name="zyl_price" class="layui-input" type="text" placeholder="请输入众易链价格" value="{{$data['zyl_price']}}" autocomplete="off" lay-verify="number">
    </div>
  </div>
   
   <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>强制锁仓</legend>
</fieldset>
   <div class="layui-form-item">
    <label class="layui-form-label">强制锁仓</label>
    <div class="layui-input-inline">
	<input name="matching_day" class="layui-input" type="text" placeholder="请输入众易链价格" value="{{$data['matching_day']}}" autocomplete="off" lay-verify="number">
	</div>
	<div class="layui-form-mid layui-word-aux">天</div>
  </div>
   
   

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>动态收益</legend>
</fieldset>
  <div class="layui-form-item">
    <label class="layui-form-label">动态收益小区百分比</label>
    <div class="layui-input-inline">
      <input name="dynamic_profit_inserest" class="layui-input" type="text" placeholder="请输入动态收益小区百分比" value="{{$data['dynamic_profit_inserest']}}" autocomplete="off" lay-verify="number">
    </div>
    <div class="layui-form-mid layui-word-aux">%</div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">动态收益限制(不能超过自身锁仓的百分比)</label>
    <div class="layui-input-inline">
      <input name="dynamic_profit_restrict" class="layui-input" type="text" placeholder="动态收益限制" value="{{$data['dynamic_profit_restrict']}}" autocomplete="off" lay-verify="number">
    </div>
    <div class="layui-form-mid layui-word-aux">%</div>
  </div>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>静态收益</legend>
</fieldset>
<div class="layui-form-item">
@foreach ($data['static_profit'] as $k => $v)
	<div class="layui-inline">
		<label class="layui-form-label">金额</label>
		<div class="layui-input-inline" style="width: 100px;">
			<input type="text" name="static_profit[{{$k}}][money]" placeholder="" value="{{$v['money']}}" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid">利率</div>
		<div class="layui-input-inline" style="width: 100px;">
			<input type="text" name="static_profit[{{$k}}][interest]" placeholder="" value="{{$v['interest']}}" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux">%</div>
	</div>
@endforeach
</div>

    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>提币限制</legend>
</fieldset>
<div class="layui-form-item">

	<div class="layui-inline">
		<label class="layui-form-label">最小金额</label>
		<div class="layui-input-inline" style="width: 100px;">
			<input type="text" name="extracts_num[min]" placeholder="" value="{{$data['extracts_num']['min']}}" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid">提币为</div>
		<div class="layui-input-inline" style="width: 100px;">
			<input type="text" name="extracts_num[times]" placeholder="" value="{{$data['extracts_num']['times']}}" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux">的倍数</div>
  </div>
  
  <div class="layui-inline">
		<label class="layui-form-mid">转入钱包比例</label>
		<div class="layui-input-inline" style="width: 100px;">
			<input type="text" name="extracts_interest[wallect]" placeholder="" value="{{$data['extracts_interest']['wallect']}}" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">%</div>
		<div class="layui-form-mid">转为消费积分比例</div>
		<div class="layui-input-inline" style="width: 100px;">
			<input type="text" name="extracts_interest[consume]" placeholder="" value="{{$data['extracts_interest']['consume']}}" autocomplete="off" class="layui-input">
		</div>
    <div class="layui-form-mid layui-word-aux">%</div>
    <div class="layui-form-mid">手续费比例</div>
		<div class="layui-input-inline" style="width: 100px;">
			<input type="text" name="extracts_interest[interest]" placeholder="" value="{{$data['extracts_interest']['interest']}}" autocomplete="off" class="layui-input">
		</div>
		<div class="layui-form-mid layui-word-aux">%</div>
  </div>
  
</div>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>注册币抵扣激活币比例</legend>
</fieldset>
  <div class="layui-form-item">
    <label class="layui-form-label">注册币</label>
    <div class="layui-input-inline">
      <input class="layui-input" type="text" placeholder="" name="agio_interest" value="{{$data['agio_interest']}}" autocomplete="off" lay-verify="number">
    </div>
    <div class="layui-form-mid layui-word-aux">%</div>
  </div>

  <!-- <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>提币</legend>
</fieldset>
  <div class="layui-form-item">
    <label class="layui-form-label">手续费</label>
    <div class="layui-input-inline">
      <input class="layui-input" type="text" placeholder="" name="hcSxf" value="20.00" autocomplete="off" lay-verify="number">
    </div>
    <div class="layui-form-mid layui-word-aux">%</div>
  </div>

<div class="layui-form-item">
    <label class="layui-form-label">最低</label>
    <div class="layui-input-inline">
      <input class="layui-input" type="text" placeholder="" name="hcLowB" value="100.00" autocomplete="off" lay-verify="number">
    </div>
  </div>
  
<div class="layui-form-item">
<label class="layui-form-label"></label>
    <div class="layui-input-inline">
      <input class="layui-input" type="text" placeholder="" name="hcSxfBs" value="100.00" autocomplete="off" lay-verify="number">
    </div>
    <div class="layui-form-mid layui-word-aux">的倍数</div>
  </div>-->

   <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>充值地址</legend>
</fieldset> 

<div class="layui-form-item">
@foreach($data['recharge_address'] as $k => $v)	
    <label class="layui-form-label">币种</label>
    <div class="layui-input-inline">
      <input name="recharge_address[{{$k}}][type]" value="{{$v['type']}}" class="layui-input" type="text" placeholder=""  autocomplete="off">
    </div>
    <label class="layui-form-label">地址</label>
    <div class="layui-input-inline">
      <input name="recharge_address[{{$k}}][address]" value="{{$v['address']}}" class="layui-input" type="text" placeholder=""  autocomplete="off">
	</div>
@endforeach
</div>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>注册币抵扣激活币比例</legend>
</fieldset>

  <div class="layui-form-item">
    <label class="layui-form-label">ATEC(众易链)转激活币</label>
    <div class="layui-input-inline">
    <input type="checkbox" name="money_change[zyl_register]" lay-skin="switch" lay-text="开|关"
      @if($data['money_change']['zyl_register']=='on')
      checked
      @endif
    />
    </div>
    <label class="layui-form-label">激活币转注册币</label>
    <div class="layui-input-inline">
    <input type="checkbox" name="money_change[register_agio]" lay-skin="switch" lay-text="开|关"
    @if($data['money_change']['register_agio']=='on')
      checked
      @endif 
      />
    </div>
    <label class="layui-form-label">消费币转注册币</label>
    <div class="layui-input-inline">
    <input type="checkbox" name="money_change[consume_agio]" lay-skin="switch" lay-text="开|关"
    @if($data['money_change']['consume_agio']=='on')
      checked
      @endif 
      />
    </div>
  </div>


<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>每日释放比例</legend>
</fieldset>
  <div class="layui-form-item">
    <label class="layui-form-label">每日释放比例</label>
    <div class="layui-input-inline">
      <input class="layui-input" type="text" placeholder="" name="release_interest" value="{{$data['release_interest']}}" autocomplete="off" lay-verify="number">
    </div>
    <div class="layui-form-mid layui-word-aux">%</div>
  </div>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend>算力转换开关</legend>
</fieldset>
<label class="layui-form-label">算力转换开关</label>
    <div class="layui-input-inline">
    <input type="checkbox" name="profit_change" lay-skin="switch" lay-text="开|关"
      @if($data['profit_change']=='on')
      checked
      @endif
    />
    </div>


  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-filter="msgsubmit" lay-submit="">确认修改</button>
    </div>
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
			  var index = layedit.build('demo', {
					hideTool: ['image']
					,uploadImage: {
					    url: '/admin/upload' //接口url
					    ,type: '' //默认post
					  }
					});
			//自定义验证规则
			form.verify({
				title: function(value){
					if(value.length < 2){
						return '标题至少得2个字符啊';
					}
				},
				content: function(value){
					 return layedit.sync(index);
				}
			});
			
			 //监听提交
			  form.on('submit(msgsubmit)', function(data){
				   //对话框
	  			   	 layer.confirm('您确定要提交吗？', function(index){
	  			   		 //发送请求  admin 指向后台 sendmsg 后台方法
	  			          $.post('/admin/bonus_set_make',
	  			   	    		data.field,//这个是表单序列化值
	  			   	    		function(obj){
	  			   	    	          if(obj.Status=='ok'){
	  			   	    	        	layer.msg('修改成功');
	  			   	    	          }else{
	  			   	    	        	layer.msg('修改失败');
	  			   	    	          }
	  		            	});	 
	  				 });
			    return false;
			  });		 
		});
	</script>
</body></html>
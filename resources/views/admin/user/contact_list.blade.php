<html lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<meta name="keywords" content="会员结算系统">
<meta name="description" content="会员结算系统">
<link href="/layui/css/bootstrap.css" rel="stylesheet">
<link href="/layui/css/iosoverlay.css" rel="stylesheet">
<link href="/layui/css/simple-line-icons.css" rel="stylesheet">
<link href="/layui/css/font-awesome.min.css" rel="stylesheet">
<link href="/layui/css/jquery.orgchart.css" rel="stylesheet">
<link href="/layui/css/bealert.css" rel="stylesheet">
<link href="/layui/css/toastr.css" rel="stylesheet">
<link href="/layui/css/bootstrap-datetimepicker.css" rel="stylesheet">
<link href="/layui/css/engine.css" rel="stylesheet">
<style type="text/css">
.bg-glass {
	background-color: none;
}

.list-group-item, .list-group-item:hover, .list-group-item:focus {
	background-color: transparent !important;
	color: #fff !important;
	border: none;
}

.pages {
	color: #999;
	overflow: auto;
}

.pages a, .pages .cpb {
	text-decoration: none;
	float: left;
	padding: 0 5px;
	border: 1px solid #ddd;
	background: #ffff;
	margin: 0 2px;
	font-size: 11px;
	color: #000;
}

.pages a:hover {
	background-color: #E61636;
	color: #fff;
	border: 1px solid #E61636;
	text-decoration: none;
}

.pages .cpb {
	font-weight: bold;
	color: #fff;
	background: #E61636;
	border: 1px solid #E61636;
}

#Table1 tbody {
	background-size: 200px 400px;
}

#Table1 {
	background: url(/layui/images/button.png) no-repeat center center;
	background-size: 200px 150px;
	height: 150px;
	width: 188px;
	margin-top: 25px;
	margin-right: 10px;
	border-radius: 10px;
}

table {
	border-collapse: collapse;
}

#Table1 tr, #Table1 tr td {
	height: 20px;
	line-height: 20px;
}

#Table1 tbody tr:nth-of-type(2), #Table1 tbody tr:nth-of-type(2) td {
	margin-top: -20px;
}
</style>
<script type="text/javascript" src="/layui/js/mtopt-3.0-min.js"></script>
<script type="text/javascript" src="/layui/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/layui/js/bealert.js"></script>
<script type="text/javascript" src="/layui/js/bootstrap.js"></script>
<script type="text/javascript" src="/layui/js/iosoverlay.js"></script>
<script type="text/javascript" src="/layui/js/jquery.orgchart.js"></script>
<script type="text/javascript" src="/layui/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="/layui/js/bootstrap-datetimepicker.zh-cn.js"></script>
<script type="text/javascript" src="/layui/js/toastr.js"></script>
<script type="text/javascript" src="/layui/js/spin.min.js"></script><style type="text/css"></style>
<script type="text/javascript" src="/layui/js/engine.js"></script>
<script type="text/javascript" src="/layui/js/settimeqt.js"></script>
	<script type="text/javascript">
		      function tjf(){
		    	//发送请求  admin 指向后台 sendmsg 后台方法
		          $.post('/admin/isexitshu',
		        		    $("#form1").serialize(),//这个是表单序列化值
		   	    			function(obj){
		   	    	            if(obj.Status=='ok'){
		   	    	        	 var form = document.getElementById('form1');
                                 form.submit();
		   	    	          }else{
		   	    	        	alert(obj.Erro); 
		   	    	          }
	            	});	 
		      }
		</script>
<style type="text/css">
.bg-glass {
	background-color: none;
}
.list-group-item, .list-group-item:hover, .list-group-item:focus {
	background-color: transparent !important;
	color: #fff !important;
	border: none;
}
.pages {
	color: #999;
	overflow: auto;
}
.pages a, .pages .cpb {
	text-decoration: none;
	float: left;
	padding: 0 5px;
	border: 1px solid #ddd;
	background: #ffff;
	margin: 0 2px;
	font-size: 11px;
	color: #000;
}
.pages a:hover {
	background-color: #E61636;
	color: #fff;
	border: 1px solid #E61636;
	text-decoration: none;
}
.pages .cpb {
	font-weight: bold;
	color: #fff;
	background: #E61636;
	border: 1px solid #E61636;
}
.Table1 tbody {
	background-size: 200px 400px;
}
.Table1 {
	background: url(/user/images/button.png) no-repeat center center;
	background-size: 200px 150px;
	height: 150px;
	width: 188px;
	margin-top: 25px;
	margin-right: 10px;
	border-radius: 10px;
}
table {
	border-collapse: collapse;
}
.Table1 tr, .Table1 tr td {
	height: 20px;
	line-height: 20px;
}
.Table1 a {
    color: #fff;
}
.Table1 tbody tr:nth-of-type(2), .Table1 tbody tr:nth-of-type(2) td {
	margin-top: -20px;
}
</style>
</head>

<body>

@if(!empty($type))
<form method="get" action="" id="form1">
<style>
  span.tip {display: none;}
</style>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="bb">
          <div class="page-content">
            <div class="container-fluid">
              <div class="row-fluid">
                <div class="span12">
                  <div class="portlet box grey">
                    <div class="portlet-body" style="overflow: auto;">
                      <table cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                          <tr>
                            <td valign="top" align="middle" width="100%" colspan="0">
                              <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="content">
                                <tr>
                                  <td align="center">
                                    <br> 请输入会员编号： <input style="border-radius: 5px; height: 32px; padding-left: 10px; line-height: 32px; color: #333; border: none;" name="username" value="" type="text" maxlength="20" class="span3 m-wrap"> 
																			
                                    <input style="color: #666; font-size: 14px; border: none; border-radius: 5px;" type="submit"  value="查 询 " class="btn blue"> <a href="#" class="col-xs-12">
																				＊友情提示：输入框中，不输入即为抵达网络图顶端 </a>
                                    
                                  </td>
                                </tr>
                        </tbody>
                        </table>
                        </td>
                        </tr>
                      </table>
                      </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END list INFO--></div>
          </div>
        </div>
      </div>
      <div class="panel-body" style="font-size: 1em"></div>
    </div>
  </div>
</div>
</form>
@else
	<form method="get" action="" id="form1">
	@include('admin.user._network', ['list' => $result, 'user' => $user])
	{{-- <iframe src="//zhongyilian.test/admin/tree?username={{ $username }}" width="100%" height="100%" frameborder="0"></iframe> --}}
	</form>
@endif
	
</body>
</html>
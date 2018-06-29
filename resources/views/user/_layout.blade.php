<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"
	/>
	<meta name="renderer" content="webkit" />
	<meta http-equiv="Cache-Control" content="no-siteapp" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<meta name="keywords" content="会员结算系统" />
	<meta name="description" content="会员结算系统" />
	<title>{{ __('首页概览') }}</title>
	<link href="/user/css/iosoverlay.css" rel="stylesheet" />
	<link href="/user/css/bootstrap.css" rel="stylesheet" />
	<link href="/user/css/simple-line-icons.css" rel="stylesheet" />
	<link href="/user/css/font-awesome.min.css" rel="stylesheet" />
	<link href="/user/css/jquery.orgchart.css" rel="stylesheet" />
	<link href="/user/css/bealert.css" rel="stylesheet" />
	<link href="/user/css/toastr.css" rel="stylesheet" />
	<link href="/user/css/bootstrap-datetimepicker.css" rel="stylesheet" />
	<link href="/user/css/engine.css" rel="stylesheet" />
	<link rel="stylesheet" href="/user/layui/css/layuiextend.css">

	{{-- <link href="/user/layui/css/layui.css" rel="stylesheet" type="text/css" /> --}}


	{{-- <script type="text/javascript" src="/user/js/mtopt-3.0-min.js"></script>
	<script type="text/javascript" src="/user/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/user/js/bealert.js"></script>
	<script type="text/javascript" src="/user/js/bootstrap.js"></script>
	<script type="text/javascript" src="/user/js/iosoverlay.js"></script>
	<script type="text/javascript" src="/user/js/jquery.orgchart.js"></script>
	<script type="text/javascript" src="/user/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript" src="/user/js/bootstrap-datetimepicker.zh-cn.js"></script>
	<script type="text/javascript" src="/user/js/toastr.js"></script>
	<script type="text/javascript" src="/user/js/echarts.common.min.js"></script>
	<script type="text/javascript" src="/user/js/spin.min.js"></script>
	<script type="text/javascript" src="/user/js/engine.js"></script>
    <script type="text/javascript" src="/user/js/settimeqt.js"></script> --}}
    {{-- <link href="/user/css/user-all.css" rel="stylesheet" /> --}}
	<script src="/user/js/user-all.js"></script>
	<script type="text/javascript" src="/user/layui/layui.js"></script>
	<style>
		.bg-glass {
			background-color: none;
		}
		
		.list-group-item,
		.list-group-item:hover,
		.list-group-item:focus {
			background-color: transparent !important;
			color: #fff !important;
			border: none;
		}
		
		.pages {
			color: #999;
			overflow: auto;
		}
		
		.pages a,
		.pages .cpb {
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
		
		.table>tbody>tr>td,
		.table>tbody>tr>th,
		.table>thead>tr>th {
			border: none;
		}
		
		body{
			font-weight: bold;
			/* color: #fff; */
			/*border: 1px solid #E61636;*/
		}
		img{
			width:100%;
		}
		.part01 span {
			display: inline-block;
			margin-right: 10px;
			font-size: 14px !important;
			margin-top: -10px !important;
		}

		.part01 em {
			margin-right: 8px;
		}

		.titlewm span,
		.panel-default span {
			margin-right: 0 !important
		}

		.panel-default div {
			padding-right: 0;
		}
	</style>
</head>

<body>
	<div id="gaussian_warp" class="wrapper">
		@include('user._menu')

		<section style="position: relative;">
            @yield('content')
        </section>
	</div>
	@include('user._alert')
</body>

</html>
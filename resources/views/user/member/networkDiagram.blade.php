@extends('user._layout')
@section('content')
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
<div class="content-wrapper">
    <h3>{{__('接点网络图')}}</h3>
	<form method="get" action="" id="form1">
    @include('user.member._network', ['list' => $result, 'user' => $user])
	</form>
</div>
@endsection
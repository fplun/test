
<script type="text/javascript" src="/GoogleChart/js/jsapi.js"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages:["orgchart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Name');
    data.addColumn('string', 'Manager');
    data.addColumn('string', 'ToolTip');

    data.addRows(@json($list));

    var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
    chart.draw(data, {allowHtml:true,allowCollapse:true,size:"large"});
    }
</script>
<link rel="stylesheet" type="text/css" href="/GoogleChart/css/orgchart.css">
<form action="" method="GET">
    请输入会员编号： <input style="border-radius: 5px; height: 32px; padding-left: 10px; line-height: 32px; color: #333; border: none;" name="username" value="{{ $username }}" type="text" maxlength="20" class="span3 m-wrap"> 
																			
    <input style="color: #666; font-size: 14px; border: none; border-radius: 5px;" type="submit"  value="查 询 " class="btn blue"> 
    <a href="#" class="col-xs-12">＊友情提示：输入框中，不输入即为抵达网络图顶端 </a>
</form>
</form>
<div id="chart_div""></div>

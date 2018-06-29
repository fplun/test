<html><head>
  <meta charset="utf-8">
  <title>消息中心</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
  <link rel="stylesheet" href="/layui/zTree_v3/css/zTreeStyle.css" type="text/css"> 
    <script type="text/javascript" src="/layui/js/jquery-1.4.4.min.js"></script>
    <script type="text/javascript" src="/layui/zTree_v3/js/jquery.ztree.core.js"></script> 
     <script language="JavaScript">
   var zTreeObj;
   // zTree 的参数配置，深入使用请参考 API 文档（setting 配置详解）
   var setting = {  
    async:{  
        autoParam:["id"],  
        enable:true,  
        type:"get",  
        url:"/admin/gettjtree"  
    }  
    ,data:{  
        simpleData :{  
           enable:true ,    
           idKey : "id", // id编号命名     
           pIdKey : "pId", // 父id编号命名      
           rootId : 0   
        }  
    } , 
    callback: {  
    	onAsyncSuccess: function(treeId, treeNode) {  
            var treeObj = $.fn.zTree.getZTreeObj(treeNode);  
            var nodes = treeObj.getSelectedNodes();
            if (nodes.length>0) {
          	     zTreeObj.reAsyncChildNodes(nodes[0], "refresh");
            }
        } ,
        onExpand:function (treeId, treeNode) {
        	 var treeObj = $.fn.zTree.getZTreeObj(treeNode);  
             var nodes = treeObj.getSelectedNodes();
             if (nodes.length>0) {
           	     zTreeObj.reAsyncChildNodes(nodes[0], "refresh");
             }
        }
    } //这里是节点点击事件
 
};
   // zTree 的数据属性，深入使用请参考 API 文档（zTreeNode 节点数据详解）
   var zNodes = [
   {id:"A00000000",name:"[A00000000][公司][]", open:true,isParent:true} 
   ];
   $(document).ready(function(){
      zTreeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
   });
  </script>
    
<link id="layuicss-layer" rel="stylesheet" href="/layui/layuiadmin/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
<script type="text/javascript" src="/layui/js/settimeqt.js"></script></head>
<body layadmin-themealias="green">

  <div class="layui-fluid" id="LAY-app-message">
    <div class="layui-card">
          <fieldset class="layui-elem-field" style="height: 100%">
             <legend>推荐网络查看</legend>
                        <ul id="demo2"></ul>       
                        <ul id="treeDemo" class="ztree"><li id="treeDemo_1" class="level0" tabindex="0" hidefocus="true" treenode=""><span id="treeDemo_1_switch" title="" class="button level0 switch root_close" treenode_switch=""></span><a id="treeDemo_1_a" class="level0" treenode_a="" onclick="" target="_blank" style="" title="[A00000000][公司][]"><span id="treeDemo_1_ico" title="" treenode_ico="" class="button ico_close" style=""></span><span id="treeDemo_1_span" class="node_name">[A00000000][公司][]</span></a></li></ul>
         </fieldset>
        </div>
      </div>
</body></html>
<html><head>
  <meta charset="utf-8">
  <title>众易链俱乐部</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
  
  <script>
  /^http(s*):\/\//.test(location.href) || alert('请先部署到 localhost 下再访问');
  </script>
<link id="layuicss-layer" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
</head>
<body class="layui-layout-body" layadmin-themealias="green">
  
  <div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
      <div class="layui-header">
        <!-- 头部区域 -->
        <ul class="layui-nav layui-layout-left">
          <li class="layui-nav-item layadmin-flexible" lay-unselect="">
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
              <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
          </li>
        <!--   <li class="layui-nav-item layui-hide-xs" lay-unselect="">
            <a href="/" target="_blank" title="前台">
              <i class="layui-icon layui-icon-website"></i>
            </a>
          </li> -->
          <li class="layui-nav-item" lay-unselect="">
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
               <i class="layui-icon layui-icon-refresh"></i>  
            </a>
          </li>
                <li class="layui-nav-item" lay-unselect="">
            <a lay-href="admin/msgcenter.html" layadmin-event="message" lay-text="消息中心">
              <i class="layui-icon layui-icon-notice"></i>  
              <!-- 如果有新消息，则显示小圆点 -->
              <span class="layui-badge-dot"></span>
            </a>
          </li>
        <span class="layui-nav-bar" style="left: 30px; top: 48px; width: 0px; opacity: 0;"></span></ul>
        <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
        <span class="layui-nav-bar"></span></ul>
      </div>
      
      <!-- 侧边菜单 -->
      <div class="layui-side layui-side-menu">
        <div class="layui-side-scroll">
          <div class="layui-logo" lay-href="admin/console">
            <span>会员业绩查询管理系统</span>
          </div>
          
          <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
            <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="公告邮件管理" lay-direction="2">
                <i class="layui-icon layui-icon-template"></i>
                <cite>公告邮件管理</cite>
              <span class="layui-nav-more"></span></a>
              <dl class="layui-nav-child">
						 <dd> <a lay-href="/admin/news_list">新闻公告管理</a></dd>				  
						 <dd> <a lay-href="/admin/inbox">内部消息管理</a></dd>				  
              </dl>
            </li>
            <li data-name="user" class="layui-nav-item">
              <a href="javascript:;" lay-tips="会员信息管理" lay-direction="2">
                <i class="layui-icon layui-icon-user"></i>
                <cite>会员信息管理</cite>
              <span class="layui-nav-more"></span></a>
              <dl class="layui-nav-child">
						 <dd> <a lay-href="/admin/register">注册新会员</a></dd>				  
						 <dd> <a lay-href="/admin/no_open">未激活会员</a></dd>				  
						 <dd> <a lay-href="/admin/open">已激活会员</a></dd>				  
						 <dd> <a lay-href="/admin/frozen">封号会员管理</a></dd>				  
						<!--  <dd> <a lay-href="/admin/all_list">所有会员列表</a></dd>	 -->			  
						 <dd> <a lay-href="/admin/matching_list">配套管理</a></dd>				  
						 <!-- <dd> <a lay-href="/admin/recommend_list">推荐网络查看</a></dd>	-->				  
						 <dd> <a lay-href="/admin/contact_list">接点网络查看</a></dd> 			  
              </dl>
            </li>
            <li data-name="senior" class="layui-nav-item">
              <a href="javascript:;" lay-tips="企业财务管理" lay-direction="2">
                <i class="layui-icon layui-icon-senior"></i>
                <cite>企业财务管理</cite>
              <span class="layui-nav-more"></span></a>
              <dl class="layui-nav-child">
						 <dd> <a lay-href="/admin/subsidy_list">会员收益查询</a></dd>				  
						 <dd> <a lay-href="/admin/maintain_list">会员账号维护</a></dd>				  
						 <dd> <a lay-href="/admin/recharges_list">会员充值管理</a></dd>				  
						 <dd> <a lay-href="/admin/extracts">会员提款管理</a></dd>				  
						 <dd> <a lay-href="/admin/detailed_list">账户明细查询</a></dd>				  
						 <!-- <dd> <a lay-href="/admin/bonus_list">拨出率统计</a></dd>		 -->		  
              </dl>
            </li>
            <li data-name="set" class="layui-nav-item">
              <a href="javascript:;" lay-tips="系统设置管理" lay-direction="2">
                <i class="layui-icon layui-icon-set"></i>
                <cite>系统设置管理</cite>
              <span class="layui-nav-more"></span></a>
             <dl class="layui-nav-child">
						 <dd> <a lay-href="/admin/manage_user">授权账号管理</a></dd>				  
						 <dd> <a lay-href="/admin/password">管理员密码修改</a></dd>				  
						 <dd> <a lay-href="/admin/on_set">系统开关设置</a></dd>				  
						 <!-- <dd> <a lay-href="/admin/security_set">系统安全设置</a></dd>		 -->		  
						 <dd> <a lay-href="/admin/bonus_set">奖金参数设置</a></dd>				  
						 <!-- <dd> <a lay-href="/admin/deal_set">股数交易流设置</a></dd>				 -->  
              </dl>
            </li>
                <li data-name="app" class="layui-nav-item">
              <a href="javascript:;" lay-tips="辅助功能管理" lay-direction="2">
                <i class="layui-icon layui-icon-app"></i>
                <cite>辅助功能管理</cite>
              <span class="layui-nav-more"></span></a>
              <dl class="layui-nav-child">
						 <dd> <a lay-href="/admin/date_set">数据结算管理</a></dd>				  
						 <dd> <a lay-href="/admin/user_log">会员日志查看</a></dd>				  
						 <dd> <a lay-href="/admin/admin_log">管理员日志查看</a></dd>				  
						 <!-- <dd> <a lay-href="/admin/import">数据导入</a></dd>		 -->		  
              </dl>
            </li>
                   <li data-name="template" class="layui-nav-item">
              <a href="javascript:;" lay-tips="退出系统" lay-direction="2">
                <i class="layui-icon layui-icon-template"></i>
                <cite>退出系统</cite>
              <span class="layui-nav-more"></span></a>
              <dl class="layui-nav-child">
                      <dd><a href="/admin/lout">退出系统</a></dd>
              </dl>
            </li>
          <span class="layui-nav-bar" style="top: 84px; height: 0px; opacity: 0;"></span></ul>
        </div>
      </div>

      <!-- 页面标签 -->
      <div class="layadmin-pagetabs" id="LAY_app_tabs">
        <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
        <div class="layui-icon layadmin-tabs-control layui-icon-down">
          <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect="">
              <a href="javascript:;"><span class="layui-nav-more"></span></a>
              <dl class="layui-nav-child layui-anim-fadein">
                <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
              </dl>
            </li>
          <span class="layui-nav-bar"></span></ul>
        </div>
        <div class="layui-tab" lay-unauto="" lay-allowclose="true" lay-filter="layadmin-layout-tabs">
          <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="admin/console.html" class="layui-this"><i class="layui-icon layui-icon-home"></i><i class="layui-icon layui-unselect layui-tab-close">ဆ</i></li>
          </ul>
        </div>
      </div>
      
      
      <!-- 主体内容 -->
      <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
          <iframe src="/admin/home" frameborder="0" class="layadmin-iframe"></iframe>
        </div>
      </div>
      
      <!-- 辅助元素，一般用于移动设备下遮罩 -->
      <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
  </div>

  <script src="/layui/layui-v2.2.5/layui/layui.js"></script>
  <script src="/layui/js/jquery-1.4.4.min.js"></script> 
  <script src="/layui/js/settime.js"></script>
  <script>
  layui.config({
    base: '/layui/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use('index');
  </script>

<style id="LAY_layadmin_theme">.layui-side-menu,.layadmin-pagetabs .layui-tab-title li:after,.layadmin-pagetabs .layui-tab-title li.layui-this:after,.layui-layer-admin .layui-layer-title,.layadmin-side-shrink .layui-side-menu .layui-nav>.layui-nav-item>.layui-nav-child{background-color:#3A3D49 !important;}.layui-nav-tree .layui-this,.layui-nav-tree .layui-this>a,.layui-nav-tree .layui-nav-child dd.layui-this,.layui-nav-tree .layui-nav-child dd.layui-this a{background-color:#5FB878 !important;}.layui-layout-admin .layui-logo{background-color:#2F9688 !important;}}</style></body></html>
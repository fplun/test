<html><head>
  <meta charset="utf-8">
  <title>layuiAdmin 控制台主页一</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <link rel="stylesheet" href="/layui/layuiadmin/layui/css/layui.css" media="all">
  <link rel="stylesheet" href="/layui/layuiadmin/style/admin.css" media="all">
  <script type="text/javascript" src="/layui/js/jquery-1.10.2.min.js" ></script>
  <script type="text/javascript" src="/layui/layui-v2.2.5/layui/layui.js" ></script>
<script type="text/javascript" src="/layui/js/settimeqt.js"></script>
<link id="layuicss-layer" rel="stylesheet" href="/layui/layui-v2.2.5/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">
<script async="" charset="utf-8" src="/layui/layuiadmin/modules/console.js"></script>
<style>
	.mian_tianqi{position: relative;}
	.mian_tianqi:after{content:" "; display: block; width:100%; height:100%; position: absolute; z-index:10;top: 0; left: 0;}
</style>
</head>
<body>
  
  <div class="layui-fluid">
    <div class="layui-row layui-col-space15">
      <div class="layui-col-md8">
        <div class="layui-row layui-col-space15">
           
           
           <div class="layui-col-md12">
            <div class="layui-card">
              <div class="layui-card-header">天气预报</div>
              <div class="layui-card-body">
                        <div class="mian_tianqi">          
                            <iframe width="420" scrolling="no" height="60" frameborder="0" allowtransparency="true" src="http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=3&site=12"></iframe>
                    		</div>
              </div>
            </div>
          </div>
          
          
          <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">管理员信息</div>
              <div class="layui-card-body">
                
                <div class="layui-carousel layadmin-carousel layadmin-shortcut">
                   <div class="layui-card-body layui-text">
            <table class="layui-table">
              <colgroup>
                <col width="100">
                <col>
              </colgroup>
              <tbody>
                <tr>
                  <td>管理员</td>
                  <td>
                     {{$admin_user->username}} 
                  </td>
                </tr>
                <tr>
                  <td>上次登录IP</td>
                  <td>
                  {{empty($admin_log->ip)?'':$admin_log->ip}} 
                 </td>
                </tr>
                <tr>
                  <td>时间</td>
                  <td>  {{empty($admin_log->created_at)?'':$admin_log->created_at}} </td>
                </tr>
              </tbody>
            </table>
          </div>
                </div>
                
              </div>
            </div>
          </div>
         
         <div class="layui-col-md6">
            <div class="layui-card">
              <div class="layui-card-header">会员信息</div>
              <div class="layui-card-body">
                
                <div class="layui-carousel layadmin-carousel layadmin-shortcut">
                   <div class="layui-card-body layui-text">
            <table class="layui-table">
              <colgroup>
                <col width="100">
                <col>
              </colgroup>
              <tbody>
                <tr>
                  <td>总会员数</td>
                  <td>
                   {{$user['user']}}
                  </td>
                </tr>
                <tr>
                  <td>已激活</td>
                  <td>
                  {{$user['jihuo']}}
                 </td>
                </tr>
                <tr>
                  <td>未激活</td>
                  <td>   {{$user['no_jihuo']}}</td>
                </tr>
                    <tr>
                  <td>今日新增</td>
                  <td>   {{$user['new_user']}}</td>
                </tr>
              </tbody>
            </table>
          </div>
                </div>
                
              </div>
            </div>
          </div>
         
         
        </div>
      </div>
      
      <div class="layui-col-md4">
        <div class="layui-card">
          <div class="layui-card-header">总拨出率</div>
          <div class="layui-card-body layui-text">
            <table class="layui-table">
              <colgroup>
                <col width="100">
                <col>
              </colgroup>
              <tbody>
                <tr>
                  <td>总锁仓</td>
                  <td>
                   {{$matching['money']}}
                  </td>
                </tr>
                <tr>
                  <td>总产出收益</td>
                  <td>
                  {{$profit}}
                 </td>
                </tr>
                  <tr>
                  <td>总释放金额</td>
                  <td>
                   {{$matching['release_money']}}
                 </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        
        <div class="layui-card">
          <!-- <div class="layui-card-header">拨出报告</div>
          <div class="layui-card-body layadmin-takerates">
            <div class="layui-progress" lay-showpercent="yes">
              <h3>转化率（日同比 0% <span class="layui-edge layui-edge-top" lay-tips="增长" lay-offset="-15"></span>）</h3>
              <div class="layui-progress-bar" lay-percent="0%" style="width: 0%;"><span class="layui-progress-text">0%</span></div>
            </div> -->
         <!--    <div class="layui-progress" lay-showPercent="yes">
              <h3>签到率（日同比 11% <span class="layui-edge layui-edge-bottom" lay-tips="下降" lay-offset="-15"></span>）</h3>
              <div class="layui-progress-bar" lay-percent="32%"></div>
            </div> -->
          </div>
        </div>
        
       <!--  <div class="layui-card">
          <div class="layui-card-header">实时监控</div>
          <div class="layui-card-body layadmin-takerates">
            <div class="layui-progress" lay-showPercent="yes">
              <h3>CPU使用率</h3>
              <div class="layui-progress-bar" lay-percent="58%"></div>
            </div>
            <div class="layui-progress" lay-showPercent="yes">
              <h3>内存占用率</h3>
              <div class="layui-progress-bar layui-bg-red" lay-percent="90%"></div>
            </div>
          </div>
        </div> -->
        
        <!-- <div class="layui-card">
          <div class="layui-card-header">产品动态</div>
          <div class="layui-card-body">
            <div class="layui-carousel layadmin-carousel layadmin-news" data-autoplay="true" data-anim="fade" lay-filter="news">
              <div carousel-item>
                <div><a href="http://fly.layui.com/docs/2/" target="_blank" class="layui-bg-red">layuiAdmin 快速上手文档</a></div>
                <div><a href="javascript:;" onclick="layer.msg('等待添加')" target="_blank" class="layui-bg-green">layuiAdmin 集成心得分享</a></div> 
                <div><a href="javascript:;" onclick="layer.msg('等待添加')" target="_blank" class="layui-bg-blue">首款 layui 官方后台模板系统正式发布</a></div>
              </div>
            </div>
          </div>
        </div> -->

        <!-- <div class="layui-card">
          <div class="layui-card-header">
            作者心语
            <i class="layui-icon layui-icon-tips" lay-tips="要支持的噢" lay-offset="5"></i>
          </div>
          <div class="layui-card-body layui-text layadmin-text">
            <p>一直以来，layui 秉承无偿开源的初心，虔诚致力于服务各层次前后端 Web 开发者，在商业横飞的当今时代，这一信念从未动摇。即便身单力薄，仍然重拾决心，埋头造轮，以尽可能地填补产品本身的缺口。</p>
            <p>在过去的一段的时间，我一直在寻求持久之道，已维持你眼前所见的一切。而 layuiAdmin 是我们尝试解决的手段之一。我相信真正有爱于 layui 生态的你，定然不会错过这一拥抱吧。</p>
            <p>子曰：君子不用防，小人防不住。请务必通过官网正规渠道，获得 <a href="http://www.layui.com/admin/" target="_blank">layuiAdmin</a>！</p>
            <p>—— 贤心（<a href="http://www.layui.com/" target="_blank">layui.com</a>）</p>
          </div>
        </div> -->
      </div>
      
    </div>
  </div>

  <script src="/layui/layui-v2.2.5/layui/layui.js?t=1"></script>  
  <script>
 /* layui.config({
    base: '/layui/layuiadmin/' //静态资源所在路径
  }).extend({
    index: 'lib/index' //主入口模块
  }).use(['index', 'console']);*/
  </script>


</body></html>
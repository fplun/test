<!-- 顶部菜单 -->
		<header class="topnavbar-wrapper  navbar-fixed-top">
			<nav class="navbar topnavbar" style="height:3.6em;">
				<!-- 图标控制-->
				<div class="navbar-header">
					<a href="" class="navbar-brand" style="color:white;">
						<div class="brand-logo" style="font-size:30px">
							ATEC
						</div>
						<div class="brand-logo-collapsed">
							ATEC
						</div>
					</a>
				</div>
				<!-- 菜单按钮-->
				<div class="nav-wrapper">
					<ul class="nav navbar-nav">
						<li>
							<a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
								<em class="fa fa-navicon"></em>
							</a>
							<a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
								<em class="fa fa-navicon"></em>
							</a>
						</li>
					</ul>
				</div>
				<div class="contri" style="display: inline-block; position: absolute; top: 5px; right: 50px;z-index:100000;">
					<a href="/?_locale=en_US">
						<img src="/user/images/USA.jpg" alt="">
					</a>
					<a href="/?_locale=zh_CN">
						<img src="/user/images/china.jpg" alt="">
					</a>
					<a href="/?_locale=ko_KR">
						<img src="/user/images/korean.jpg" alt="">
					</a>
					<a href="/?_locale=ja_JP">
						<img src="/user/images/japan.jpg" alt="">
					</a>
				</div>
			</nav>
		</header>
		<!-- 侧边栏-->


		<!-- 侧边栏-->
		<aside class="aside">
			<div class="aside-inner">
				<nav class="sidebar">
					<ul class="nav">
						<li class="nav-heading">
							<span>{{ __('欢迎使用') }}</span>
						</li>
						<li>
							<a href="#message1" title="Layouts" data-toggle="collapse">
								<em class="icon-globe"></em>
								<span>{{ __('切换语言') }}</span>
								<i class="fa fa-th-list" style="float: right;" aria-hidden="true"></i>
							</a>
							<ul id="message1" class="nav sidebar-subnav collapse">
								<li class="">
									<a href="#mess2" title="Layouts" data-toggle="collapse">
										<span>{{ __('中文版') }}</span>
										<i class="fa fa-th-list hidden-xs" style="float: right;" aria-hidden="true"></i>
									</a>
									<div id="mess2" class="nav sidebar-subnav collapse">
										<a href="/?_locale=zh_TW">
											<span class="text-left">中文繁體</span>
										</a>
										<a href="/?_locale=zh_CN">
											<span class="text-left">中文简体</span>
										</a>
									</div>
								</li>
								<li class="">
									<a href="/?_locale=en_US">
										<span>English</span>
									</a>
								</li>
								<li class="">
									<a href="/?_locale=ko_KR">
										<span>한국어</span>
									</a>
								</li>
								<li class="">
									<a href="/?_locale=ja_JP">
										<span>日本語</span>
									</a>
								</li>
							</ul>
						</li>

						<li>
							<a href="#message2" title="Layouts" data-toggle="collapse">
								<em class="icon-user"></em>
								<span>{{ __('我的账户') }}</span>
								<i class="fa fa-th-list" style	="float: right;" aria-hidden="true"></i>
							</a>
							<ul id="message2" class="nav sidebar-subnav collapse">
								<li class="">
									<a href="/">
										<span>{{ __('首页') }}</span>
									</a>
								</li>
								<li class="">
									<a href="/resetLoginPwd">
										<span>{{ __('更改登录密码') }}</span>
									</a>
								</li>
								<li class="">
									<a href="/resetSafePwd">
										<span>{{ __('更改安全密码') }}</span>
									</a>
								</li>
								<li class="">
									<a href="/useredit">
										<span>{{ __('个人信息资料') }}</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#message3" title="Layouts" data-toggle="collapse">
								<em class="icon-people"></em>
								<span>{{ __('会员管理') }}</span>
								<i class="fa fa-th-list" style="float: right;" aria-hidden="true"></i>
							</a>
							<ul id="message3" class="nav sidebar-subnav collapse">
								<li class="">
									<a href="/userreg">
										<span>{{ __('立即注册') }}</span>
									</a>
								</li>
								<li class="">
									<a href="/recmlists">
										<span>{{ __('激活用户') }}</span>
									</a>
								</li>
								{{-- <li class="">
									<a href="useraudio">
										<span>{{ __('会员审核') }}</span>
									</a>
								</li> --}}
								<li class="">
									<a href="networkDiagram">
										<span>{{ __('接点图谱') }}</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#message4" title="Layouts" data-toggle="collapse">
								<em class="icon-info"></em>
								<span>{{ __('账户中心') }}</span>
								<i class="fa fa-th-list" style="float: right;" aria-hidden="true"></i>
							</a>
							<ul id="message4" class="nav sidebar-subnav collapse">
								<li class="">
									<a href="tctz">
										<span>{{ __('增加配套') }}</span>
									</a>
								</li>
								<li class="">
									<a href="taochan">
										<span>{{ __('配套管理') }}</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#message5" title="Layouts" data-toggle="collapse">
								<em class="icon-diamond"></em>
								<span>{{ __('资产管理') }}</span>
								<i class="fa fa-th-list" style="float: right;" aria-hidden="true"></i>
							</a>
							<ul id="message5" class="nav sidebar-subnav collapse">
								<!-- <li class="">
									<a href="tozcsy">
										<span>{{ __('分享补贴') }}</span>
									</a>
								</li> -->
								<li class="">
									<a href="tofxbt">
										<span>{{ __('收益记录') }}</span>
									</a>
								</li>
								<li class="">
									<a href="transfernbzz">
										<span>{{ __('算力转换') }}</span>
									</a>
								</li>
								<li class="">
									<a href="transfer">
										<span>{{ __('会员转账') }}</span>
									</a>
								</li>
								<li class="">
									<a href="transferlist">
										<span>{{ __('转账记录') }}</span>
									</a>
								</li>
								<li class="">
									<a href="remittance">
										<span>{{ __('申请充值') }}</span>
									</a>
								</li>
								<li class="">
									<a href="remittancelist">
										<span>{{ __('充值记录') }}</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#message6" title="Layouts" data-toggle="collapse">
								<em class="icon-graph"></em>
								<span>{{ __('数字资产') }}</span>
								<i class="fa fa-th-list" style="float: right;" aria-hidden="true"></i>
							</a>
							<ul id="message6" class="nav sidebar-subnav collapse">
								<!-- <li class="">
									<a href="tozylmx">
										<span>{{ __('众易链明细') }}</span>
									</a>
								</li>-->
								<li class="">
									<a href="togzyl">
										<span>{{ __('币种转换') }}</span>
									</a>
								</li> 
								<li class="">
									<a href="whitdraw">
										<span>{{ __('提币') }}</span>
									</a>
								</li>
								<li class="">
									<a href="whitdrawlist">
										<span>{{ __('提币记录') }}</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#message7" title="Layouts" data-toggle="collapse">
								<em class="icon-envelope"></em>
								<span>{{ __('公告中心') }}</span>
								<i class="fa fa-th-list" style="float: right;" aria-hidden="true"></i>
							</a>
							<ul id="message7" class="nav sidebar-subnav collapse">
								<li class="">
									<a href="notice">
										<span>{{ __('新闻公告') }}</span>
									</a>
								</li>
								<li>
									<a href="#mail" title="Layouts" data-toggle="collapse">
										<em class="icon-bubbles"></em>
										<span>{{ __('内部邮箱') }}</span>
										<i class="fa fa-th-list" style="float: right;" aria-hidden="true"></i>
									</a>
									<ul id="mail" class="nav sidebar-subnav collapse">
										<li class="">
											<a href="/sendNotice">
												<span>{{ __('发邮件') }}</span>
											</a>
										</li>
										<li class="">
											<a href="/sendlists">
												<span>{{ __('发件箱') }}</span>
											</a>
										</li>
										<li class="">
											<a href="/collectlists">
												<span>{{ __('收件箱') }}</span>
											</a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="home-main">
							<a id="Link_exit" href="/logout">
								<em class="icon-logout"></em>
								<span>{{ __('注销登录') }}</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</aside>
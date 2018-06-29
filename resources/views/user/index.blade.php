@extends('user._layout')
@section('content')
<style>
	.price0{position:absolute;left:60px;top:120px;font-size:16px;color:#fff;}
	@media screen and (max-width:768px) {
		.price0{left:30px;top:80px;font-size:14px;}
	}
</style>
<div class="content-wrapper" style="margin-top: 0;position: relative;z-index: 2000000;">
		<div class="content-heading banner" style="border-top:1px solid #e6e6e6;position:relative;">
			<img style="width: 100%; margin-top: 54px; display: block;" src="/user/images/wmbg_{{ $locale }}.jpg" />
			<p class="price0">{{ __('ATEC价格') }}:<span>{{$set['zyl_price']}}$</span></p>
		</div>
		<div class="row part01">
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left">{{ __('投资金额') }}</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-wallet fa-3x"></em>
							<span class="h2 mt0">{{ $matching_money }}$</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left">ATEC（{{ __('锁仓数量') }}）</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-star fa-3x"></em>
							<span class="h2 mt0">{{$matching_zyl_num}}</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left">ATEC（{{ __('交易数量') }}）</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-star fa-3x"></em>
							<span class="h2 mt0">{{$account->zyl_money}}</span>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left">{{ __('静态收益') }}</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-present fa-3x"></em>
							<span class="h2 mt0">{{$profit['ji']}}$</span>
						</div>
					</div>
				</div>
			</div> 
			 <div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left">{{ __('动态收益') }}</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-graph fa-3x"></em>
							<span class="h2 mt0">{{$profit['dong']}}$</span>
						</div>
					</div>
				</div>
			</div> 
			 <div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left">{{ __('总收益') }}</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-trophy fa-3x"></em>
							<span class="h2 mt0">{{$profit['all_profit']}}$</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left"> {{ __('激活币') }}</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-trophy fa-3x"></em>
							<span class="h2 mt0">{{$account->register}}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left">{{ __('注册币') }}</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-trophy fa-3x"></em>
							<span class="h2 mt0">{{$account->agio}}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="panel widget bg-glass">
					<div class="row row-table">
						<div class="col-xs-4 pv-lg">
							<div class="h2 mt0"></div>
							<div class="text-uppercase text-left">{{ __('消费币') }}</div>
						</div>
						<div class="col-xs-8 text-right bg-glass pv-lg" style="background: none">
							<em class="icon-trophy fa-3x"></em>
							<span class="h2 mt0">{{$account->consume}}</span>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<aside class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">{{ __('最新资讯') }}</p>
					</div>
					<div class="panel-body titlewm">
						@foreach($news as $item)
						<a href="/newsDetail?id={{ $item->id }}">
							<span class="text-left col-xs-12 col-md-8"> {{ $item->title }}</span>
							<span class="text-right col-xs-12 col-md-4"> {{ $item->created_at }}</span>
						</a>
						@endforeach
					</div>
				</div>
			</aside>
			<aside class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<p class="panel-title">{{ __('信息资讯') }}</p>
					</div>
					<div class="panel-body" style="padding-top: 0;">
						<div class="member">
							<div class="col-xs-12 col-md-5" style="font-weight:normal;text-align:left;">
								<i class="fa fa-user" aria-hidden="true"></i>
								<a href="#">{{ __('编号') }}[{{ __('姓名') }}] ：</a>
								<span>{{ $user->username }}</span>
								<span>[{{ $user->name }}]</span>
							</div>
							<div class="col-xs-12 col-md-3" style="font-weight:normal;text-align:left">
								<span>{{ __('投资金额') }}：</span>
								<span>{{ $matching_money }}{{ __('美金') }}</span>
							</div>
							<div class="col-xs-12 col-md-4" style="font-weight:normal;text-align:left;">
								<span>{{ __('注册日期') }}：</span>
								<span>{{ $user->created_at }}</span>
							</div>
						</div>
						<div class="member">
							<div class="col-xs-12 col-md-4" style="font-weight:normal;text-align:left">
								<i class="fa fa-users" aria-hidden="true"></i>
								<a href="#">{{ __('我的团队') }}：</a>
								<span>{{ __('直推') }}</span>
								<span>{{ $direct_count }}人</span>
							</div>
							<div class="col-xs-12 col-md-3" style="font-weight:normal;text-align:left;">
								<span>{{ __('市场') }}：</span>
								<span>{{ $recommend_count }}</span>
							</div>
							<!-- <div class="col-xs-12 col-md-5" style="font-weight:normal;text-align:left;">
								<span>{{ __('团队业绩') }}：</span>
								<span>0美金</span>
							</div> -->
						</div>
						<div class="member">
							<i style="margin-left:15px;" class="fa fa-envelope-o fa-fw" aria-hidden="true"></i>
							<a href="#">{{ __('客服邮箱') }}</a>
							<span>ATECcoin@163.com</span>
						</div>
						<div class="member">
						<div class="col-xs-12 col-md-5" style="font-weight:normal;text-align:left;">
							<a href="#">{{ __('ATEC价格') }}</a>
							<span>{{$set['zyl_price']}}</span>
						</div>
						
						<!-- <div class="member">
							<div class="col-xs-12 col-md-4" style="font-weight:normal;text-align:left">
								<i class="fa fa-users" aria-hidden="true"></i>
								<a href="#">{{ __('股数交易') }}：</a>
								<span>{{ __('日交易量') }}：</span>
								<span>12</span>
							</div>
							<div class="col-xs-12 col-md-4" style="font-weight:normal;text-align:left">
								<i class="fa fa-users" aria-hidden="true"></i>
								<span>{{ __('日交易量') }}({{ __('美金') }})：</span>
								<span>1</span>
							</div>
							<div class="col-xs-12 col-md-3" style="font-weight:normal;text-align:left;">
								<span>{{ __('总交易量') }}：</span>
								<span>100</span>
							</div>
							<div class="col-xs-12 col-md-3" style="font-weight:normal;text-align:left;">
								<span>{{ __('总交易量') }}（{{ __('美金') }}）：</span>
								<span>1</span>
							</div>
						</div> -->
						<div class="member">
							<br/>
							<br/>
							<br/>
							<br/>
							<!-- 	<div class="col-xs-12 col-md-4" style="font-weight:normal;text-align:left">
										<i class="fa fa-users" aria-hidden="true"></i>
										<a href="#">三级分销：</a>
									</div>
										<div class="col-xs-12 col-md-4" style="font-weight:normal;text-align:left">
										<i class="fa fa-users" aria-hidden="true"></i>
										<span>现金币：</span>
										<span></span>
									</div>
										<div class="col-xs-12 col-md-4" style="font-weight:normal;text-align:left">
										<i class="fa fa-users" aria-hidden="true"></i>
										<span>代币积分：</span>
										<span></span>
									</div> -->
						</div>
					</div>
				</div>
		</div>
	</div>
@endsection
<?php

//我的账户
Route::get('/', 'AccountController@index');
Route::match(['get', 'post'], '/login', 'AccountController@login');
Route::get('/logout', 'AccountController@logout');
Route::get('/forgotPassword', 'AccountController@forgotPassword');
Route::match(['get', 'post'], '/toemailpwd', 'AccountController@toemailpwd');
Route::match(['get', 'post'], '/tophonepwd', 'AccountController@tophonepwd');
Route::match(['get', 'post'], '/resetPassword', 'AccountController@resetPassword');
Route::match(['get', 'post'], '/resetLoginPwd', 'AccountController@resetLoginPwd');
Route::match(['get', 'post'], '/resetSafePwd', 'AccountController@resetSafePwd');
Route::get('/forgotSafePwd', 'AccountController@forgotSafePwd');
Route::match(['get', 'post'], '/toEmailSafe', 'AccountController@toEmailSafe');
Route::match(['get', 'post'], '/toPhoneSafe', 'AccountController@toPhoneSafe');
Route::match(['get', 'post'], '/setSafePwd', 'AccountController@setSafePwd');
Route::match(['get', 'post'], '/useredit', 'AccountController@useredit');
Route::post('/sendEmailsafe', 'AccountController@sendEmailsafe');
Route::post('/sendcodesafe', 'AccountController@sendcodesafe');
Route::post('/sendcode', 'AccountController@sendcode');
Route::post('/sendEmail', 'AccountController@sendEmailCode');

//会员管理
Route::match(['get', 'post'], '/userreg', 'MemberController@userreg');
Route::post('/delete_no_open', 'MemberController@delete_no_open');
Route::post('/jihuo_no_open', 'MemberController@jihuo_no_open');
Route::match(['get', 'post'], '/recmlists', 'MemberController@recmlists');
Route::get('/recommendListJson', 'MemberController@recommendListJson');
Route::match(['get', 'post'], '/useraudio', 'MemberController@useraudio');
Route::get('/networkDiagram', 'MemberController@networkDiagram');
// Route::get('/recommendList', 'MemberController@recommendList');

//账户中心
Route::match(['get', 'post'], '/tctz', 'MemberController@tctz'); //增加配套
Route::post('/lock_add', 'MemberController@lock_add');//增加配套(锁仓)操作
Route::match(['get', 'post'], '/taochan', 'MemberController@taochan'); //配套管理
Route::get('/get_taochan', 'MemberController@get_taochan');//获取配套管理
Route::post('/release_lock', 'MemberController@release_lock');//获取配套管理
//资产管理
Route::get('/tofxbt', 'FundController@tofxbt'); //分享补贴
Route::get('/get_tofxbt', 'FundController@get_tofxbt'); //分享补贴

Route::get('/tozcsy', 'FundController@tozcsy'); //资产收益
Route::get('/transfernbzz', 'FundController@transfernbzz'); //算力转换
Route::post('/profit_transform', 'FundController@profit_transform'); //算力转换操作

Route::get('/transfer', 'FundController@transfer'); //会员转账
Route::post('/deal_make', 'FundController@deal_make');

Route::get('/transferlist', 'FundController@transferlist'); //转账记录
Route::get('/get_transferlist', 'FundController@get_transferlist'); //获取转账记录
Route::match(['get', 'post'], '/remittance', 'FundController@remittance'); //申请充值
Route::get('/remittancelist', 'FundController@remittancelist'); //充值记录
Route::get('/rechargeListJson', 'FundController@rechargeListJson');

//数字资产
Route::get('/tozylmx', 'VirtualController@tozylmx'); //众易链明细
Route::get('/togzyl', 'VirtualController@togzyl'); //购众易链
Route::post('/turn_money', 'VirtualController@turn_money');

Route::get('/whitdraw', 'VirtualController@whitdraw'); //提币
Route::post('/extracts_make', 'VirtualController@extracts_make'); //提币操作

Route::get('/whitdrawlist', 'VirtualController@whitdrawlist'); //提币记录
Route::get('/get_whitdrawlist', 'VirtualController@get_whitdrawlist'); //提币记录
//公告中心
Route::get('/notice', 'NoticeController@index'); //新闻公告
Route::get('/news', 'NoticeController@news');
Route::get('/newsDetail', 'NoticeController@newsDetail');
Route::match(['get', 'post'], '/sendNotice', 'NoticeController@sendNotice');
Route::get('/sendlists', 'NoticeController@sendLists');
Route::get('/collectlists', 'NoticeController@collectLists');
Route::get('/sendListJson', 'NoticeController@sendListJson');
Route::get('/noticeDetail', 'NoticeController@noticeDetail');
Route::post('/delNotice', 'NoticeController@delNotice');
Route::get('/collectListJson', 'NoticeController@collectListJson');

Route::get('/locale', 'TestController@locale');
Route::get('/email', 'TestController@email');
Route::get('/smssend', 'TestController@sms');
Route::get('/test', 'TestController@test');
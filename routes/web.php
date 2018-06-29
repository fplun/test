<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//后台登录
Route::group(['namespace' => 'admin'], function ($route) {
    $route->get('/admin', 'IndexController@login');
    $route->post('/admin/login_make', 'IndexController@login_make');
    $route->get('/admin/set', 'IndexController@set');
});

Route::group(['namespace' => 'admin', 'middleware' => 'admin'], function ($route) {
//首页
    $route->get('/admin/index', 'IndexController@index');
    $route->get('/admin/home', 'IndexController@home');
    $route->get('/admin/lout', 'IndexController@lout');
//系统设置
    $route->get('/admin/manage_user', 'ManageController@manage_user');
    $route->get('/admin/get_manage_user', 'ManageController@get_manage_user');
    
    $route->get('/admin/password', 'ManageController@password');
    $route->post('/admin/password_make', 'ManageController@password_make');
    
    $route->get('/admin/on_set', 'ManageController@on_set');
    $route->post('/admin/on_set_make', 'ManageController@on_set_make');

    $route->get('/admin/security_set', 'ManageController@security_set');
    $route->get('/admin/bonus_set', 'ManageController@bonus_set');
    $route->post('/admin/bonus_set_make', 'ManageController@bonus_set_make');

    $route->get('/admin/deal_set', 'ManageController@deal_set');
    $route->post('/admin/manage_add', 'ManageController@manage_add');
    $route->post('/admin/manage_update', 'ManageController@manage_update');
    $route->post('/admin/manage_delete', 'ManageController@manage_delete');

//权限模块
    $route->get('/admin/auth_list', 'AuthController@list');
    $route->post('/admin/auth_add', 'AuthController@auth_add');
    $route->get('/admin/manage_add_view', 'ManageController@manage_add_view');
//消息模块
    //新闻
    $route->get('/admin/news_list', 'NoticeController@news_list');
    $route->get('/admin/toaddnews', 'NoticeController@toaddnews');
    $route->get('/admin/get_news', 'NoticeController@get_news');
    $route->get('/admin/news_edit', 'NoticeController@news_edit');
    $route->post('/admin/news_add', 'NoticeController@news_add');
    $route->post('/admin/news_delete', 'NoticeController@news_delete');
    $route->post('/admin/news_update', 'NoticeController@news_update');
    //内部消息
    $route->get('/admin/inbox', 'NoticeController@inbox');
    $route->get('/admin/get_inbox', 'NoticeController@get_inbox');
    $route->get('/admin/look_notice', 'NoticeController@look_notice');
    $route->post('/admin/inbox_delete', 'NoticeController@inbox_delete');
    $route->get('/admin/get_outbox', 'NoticeController@get_outbox');
    $route->post('/admin/send_make', 'NoticeController@send_make');

//会员模块

    $route->get('/admin/user_login/{id}', 'UserController@user_login');//登录前台
    $route->get('/admin/register', 'UserController@register');
    $route->get('/admin/no_open', 'UserController@no_open');
    $route->post('/admin/open_make', 'UserController@open_make');
    $route->get('/admin/get_no_open', 'UserController@get_no_open');

    $route->get('/admin/open', 'UserController@open');
    $route->get('/admin/user_edit', 'UserController@user_edit');
    $route->post('/admin/user_edit_make', 'UserController@user_edit_make');
    $route->get('/admin/get_open', 'UserController@get_open');

    $route->get('/admin/all_list', 'UserController@all_list');
    $route->get('/admin/get_all_list', 'UserController@get_all_list');
    $route->post('/admin/loginUser', 'UserController@loginUser');

    $route->get('/admin/frozen', 'UserController@frozen');
    $route->get('/admin/get_frozen', 'UserController@get_frozen');
    $route->post('/admin/frozen_make', 'UserController@frozen_make');
    $route->post('/admin/thaw', 'UserController@thaw');
    $route->post('/admin/dynamic_make', 'UserController@dynamic_make');//冻结动态收益

    $route->get('/admin/matching_list', 'UserController@matching_list');
    $route->get('/admin/get_matching_list', 'UserController@get_matching_list');

    $route->get('/admin/recommend_list', 'UserController@recommend_list');
    $route->get('/admin/contact_list', 'UserController@contact_list');
    $route->get('/admin/tree', 'UserController@tree');
    $route->post('/admin/register_make', 'UserController@register_make');
    $route->get('/admin/gettjtree', 'UserController@gettjtree');
    $route->post('/admin/delete_no_open', 'UserController@delete_no_open');
    
//财务模块
    $route->get('/admin/subsidy_list', 'FinanceController@subsidy_list');
    $route->get('/admin/get_subsidy_list', 'FinanceController@get_subsidy_list');

    $route->get('/admin/maintain_list', 'FinanceController@maintain_list');
    $route->get('/admin/get_maintain_list', 'FinanceController@get_maintain_list');

    $route->get('/admin/recharge', 'FinanceController@recharge');
    $route->post('/admin/recharge_make', 'FinanceController@recharge_make');

    $route->get('/admin/recharges_list', 'FinanceController@recharges_list');
    $route->get('/admin/get_recharges_list', 'FinanceController@get_recharges_list');
    $route->get('/admin/recharge_no_pass', 'FinanceController@recharge_no_pass');
    $route->post('/admin/recharge_handle', 'FinanceController@recharge_handle');

    $route->get('/admin/extract_list', 'FinanceController@extract_list');
    $route->get('/admin/detailed_list', 'FinanceController@detailed_list');
    $route->get('/admin/get_detailed_list', 'FinanceController@get_detailed_list');

    $route->get('/admin/bonus_list', 'FinanceController@bonus_list');

    $route->get('/admin/extracts', 'FinanceController@extracts');
    $route->post('/admin/extracts_make', 'FinanceController@extracts_make');
    $route->get('/admin/get_extracts', 'FinanceController@get_extracts');

//辅助模块
    $route->get('/admin/date_set', 'AssistController@date_set');
    $route->post('/admin/truncate_table', 'AssistController@truncate_table');//清空数据
    $route->post('/admin/manual_income', 'AssistController@manual_income');//手动结算
    
    $route->get('/admin/user_log', 'AssistController@user_log');
    $route->get('/admin/get_user_log', 'AssistController@get_user_log');

    $route->get('/admin/admin_log', 'AssistController@admin_log');
    $route->get('/admin/get_admin_log', 'AssistController@get_admin_log');

    $route->get('/admin/import', 'AssistController@import');
});

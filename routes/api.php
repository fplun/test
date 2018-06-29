<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//登录模块
Route::group(['namespace' => 'Api'], function ($route) {
    $route->post('/login','LoginController@login');
    $route->post('/register','LoginController@register');
    $route->post('/send_email','LoginController@send_email');
});


Route::group(['namespace' => 'Api','middleware'=>'api.check'],function ($route){
    $route->post('/get_account','AccountController@get_account');
});
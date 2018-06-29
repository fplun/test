<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\EAccount;
use App\Models\Account;

/**
 * @title 账户
 * @description 账户相关接口
 * @header name:token require:1 default: desc:登录获取
 * @header name:id require:1 default: desc:登录获取
 */
class AccountController extends Controller
{
    /**
     * @title 总资产
     * @description 获取余额接口
     * @author 开发者
     * @url /api/get_account
     * @method POST
     * 
     */
    public function get_account(Request $request){
        if($request->e_login->type==0){
            $account=EAccount::firstOrCreate(['user_id'=>$request->e_login->user_id]);
        }else{
            $account=Account::where('user_id',$request->e_login->user_id)->first();
        }
        $account->zyl_money=empty($account->zyl_money)?'0.00':$account->zyl_money;
        $data=[
            'money'=>$account->zyl_money,
        ];
        return $this->success('成功',$data);
    }

    
}

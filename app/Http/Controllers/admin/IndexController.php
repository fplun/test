<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\AdminAuth;
use App\Models\AdminUser;
use App\Models\AdminLog;
use App\Models\Matching;
use App\Models\Profit;
use App\Models\User;
use App\Models\Set;
use Hash;

class IndexController extends Controller
{
    public function index(){
        $auth=AdminAuth::orderBy('order','asc')->orderBy('p_id','asc')->get();

        return view('admin.index.index')->with('auth',$auth);
    }
    
    public function home(Request $request){
        $admin_id=$request->session()->get('admin_id');
        $admin_user=AdminUser::where('id',$admin_id)->first();
        $admin_log=AdminLog::where('admin_id',$admin_id)->orderBy('id')->limit(1)->offset(1)->first();
        $time=date('Y-m-d',time());
        $user['user']=User::count();
        $user['jihuo']=User::where('state',1)->count();
        $user['no_jihuo']=User::where('state',0)->count();
        $user['new_user']=User::whereDate('created_at','>=',$time)->count();

        $matching['money']=Matching::where('state',0)->sum('money');
        $matching['release_money']=Matching::sum('release_money');
        $profit=Profit::sum('money');
        return view('admin.index.home')->with('admin_log',$admin_log)->with('admin_user',$admin_user)->with('user',$user)->with('matching',$matching)->with('profit',$profit);
    }

    public function login(){
        return view('admin.index.login');
    }

    public function login_make(Request $request){
        $this->validate(
            $request,
            [
                'username'=>'required|exists:admin_users',
                'password'=>'required|max:25',
                //'captcha'=>'captcha',
            ],
            [
                'username.required'=>'请输入用户名',
                'username.exists'=>'账号或密码错误',
                'password.required'=>'请输入密码',
                'password.max'=>'密码过长',
                'captcha.captcha'=>'验证码错误'
            ]
        );

        $user=AdminUser::where('username',$request->username)->first();
        if(!Hash::check($request->password,$user->password)){
            return $this->error('账号或密码错误');
        }

        $admin_log=new AdminLog;
        $admin_log->admin_id=$user->id;
        $admin_log->ip=$request->getClientIp();
        $admin_log->type=1;
        $admin_log->save();

        $request->session()->put('admin_id', $user->id);
        return $this->success('登陆成功');
    }
    
    //退出
    public function lout(){
        return redirect('/admin');
    }



    public function set(){
        //return $this->interest(1000);
        /* $set=new Set;
        $set->set_type='static_profit';
        $set->set_explain='静态收益';

        $data=[
            ['money'=>'100','interest'=>'0.1'],
            ['money'=>'1000','interest'=>'0.2'],
            ['money'=>'10000','interest'=>'0.3'],
            ['money'=>'100000','interest'=>'0.4'],
        ];
        
        $set->details=json_encode($data);
        $set->save(); */

        /* $set=new Set;
        $set->set_type='recharge_address';
        $set->set_explain='充值地址';
        $data=[
            ['type'=>'ETH','address'=>'0x0cD127174cc8a05daCe4b2B17e185470b6351aD3']
        ];
        $set->details=json_encode($data);
        $set->save();*/

        /* $set=new Set;
        $set->set_type='dynamic_profit_restrict';
        $set->set_explain='动态收益限制(不能超过自身锁仓的百分比)';
        
        $set->details='50';
        $set->save();  */

        
        /* $set=new Set;
        $set->set_type='dynamic_profit_inserest';
        $set->set_explain='动态收益利率';
        $set->details='0.2';
        $set->save(); */
        /* $set=new Set;
        $set->set_type='zyl_price';
        $set->set_explain='众易链价格';
        $set->details='1.00';
        $set->save(); */
    }

    public function interest($money){
        $data=[
            ['money'=>'100','interest'=>'0.1'],
            ['money'=>'1000','interest'=>'0.2'],
            ['money'=>'10000','interest'=>'0.3'],
            ['money'=>'100000','interest'=>'0.4'],
        ];
        $interest=0;
        foreach($data as $k => $v){
            if($v['money']<=$money){
                $interest=$v['interest'];
            }else{
                break;
            }
            echo 1;
        }
        return $interest;
    }

    public function set_look(){

    }
}

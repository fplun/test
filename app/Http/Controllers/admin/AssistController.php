<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\AdminLog;
use App\Models\User;
use App\Models\UserLog;
use App\Models\Deal;
use App\Models\Detailed;
use Rzy\Emailcode\Models\EmailCode;
use Rzy\Smscode\Models\SmsCode;
use App\Models\Extract;
use App\Models\Matching;
use App\Models\Node;
use App\Models\Notice;
use App\Models\Profit;
use App\Models\Recharge;
use App\Models\Account;
use App\Models\Set;
use App\Models\Release;

class AssistController extends Controller
{
    //数据结算管理
    public function date_set(){
        $profit=Profit::orderBy('created_at','desc')->first();
        $last_time=empty($profit->created_at)?'':$profit->created_at->toDateString();

        return view('admin.assist.date_set')->with('last_time',$last_time);
    }
    //表清空
    public function truncate_table(Request $request){
        User::truncate();
        UserLog::truncate();
        Deal::truncate();
        Detailed::truncate();
        EmailCode::truncate();
        SmsCode::truncate();
        Extract::truncate();
        Matching::truncate();
        Node::truncate();
        Notice::truncate();
        Profit::truncate();
        Recharge::truncate();
        Account::truncate();
        Release::truncate();
        return $this->success('清空数据成功');
    }

    //手动结算

    public function manual_income(Request $request){
        $profit=Profit::orderBy('created_at','desc')->first();
        if(!empty($profit->created_at)){
            $last_time=$profit->created_at->toDateString();
            $today=strtotime($last_time)+86400;
        }else{
            $today=time();
        }
        
        $date_time=date('Y-m-d',$today);
        $time=date('Y-m-d H:i:s',$today);
        $static_count=Profit::where('type',0)->whereDate('created_at',$date_time)->count();
        //执行静态收益
        if($static_count<1){
            //静态收益配置
            $static_profit=Set::where('set_type','static_profit')->first();
            $interest_data=json_decode($static_profit->details,true);

            $static_user=User::where('state',1)->where('static_type',0)->with('static_money')->get();
            $i=0;
            $static_add=[];
            foreach($static_user as $k => $v){
                $static_money=$v->static_money->sum('money');
                $static_interest=$this->static_interest($static_money,$interest_data);
                if($static_interest>0){
                    $static_profit=round($static_money*$static_interest/100,2);
                    $static_add[$i]=['user_id'=>$v->id,'money'=>$static_profit,'type'=>0,'created_at'=>$time,'updated_at'=>$time];
                    $i++;
                }
                
            }
            Profit::insert($static_add);
        }

        $dynamic_count=Profit::where('type',1)->whereDate('created_at',$date_time)->count();
        //执行动态收益
        if($dynamic_count<1){
            //动态收益配置
            $dynamic_profit_restrict=Set::where('set_type','dynamic_profit_restrict')->first()->details;
            $dynamic_profit_inserest=Set::where('set_type','dynamic_profit_inserest')->first()->details;

            $dynamic_user=User::where('state',1)->where('dynamic_type',0)->with('static_money')->with('dynamic_user')->select('id')->get();
            
            $i=0;
            $dynamic_add=[];
            foreach($dynamic_user as $user_k=>$user_v){
                //A B区  金额初始化
                $dynamic_money_A=0;
                $dynamic_money_B=0;
                if(!$user_v->dynamic_user->isEmpty()){
                    foreach ($user_v->dynamic_user as $node_k => $node_v) {
                        if(!$node_v->dynamic_matching->isEmpty()){
                            foreach ($node_v->dynamic_matching as $matching_k => $matching_v) {
                                if ($node_v->type==1) {
                                    $dynamic_money_A+=$matching_v->money;
                                } elseif ($node_v->type==2) {
                                    $dynamic_money_B+=$matching_v->money;
                                }
                            }
                        }
                    }
                }
                //A B区比较  那个小用哪个
                $dynamic_money_min=$dynamic_money_A>$dynamic_money_B?$dynamic_money_B:$dynamic_money_A;
                $dynamic_money=$dynamic_money_min*$dynamic_profit_inserest/100;
                if($dynamic_money>0){
                    //自身锁仓金额  按配置比例换算
                    $lock_money=$user_v->static_money->sum('money')*$dynamic_profit_restrict/100;
                    $dynamic_money_end=($dynamic_money>$lock_money)?$lock_money:$dynamic_money;
                    $dynamic_money_end=round($dynamic_money_end,2);
                    $dynamic_add[$i]=['user_id'=>$user_v->id,'money'=>$dynamic_money_end,'type'=>1,'created_at'=>$time,'updated_at'=>$time];
                    $i++;
                }
            }   
            Profit::insert($dynamic_add);
        }

        $release_count=Release::whereDate('created_at',$date_time)->count();
        if($release_count<1){
            $release_matchings=Matching::where('state',1)->get();
            //查询利率
            $release_interest=Set::where('set_type','release_interest')->first()->details;
            $release_interest=$release_interest/100;
            $i=0;
            $release_add=[];
            foreach($release_matchings as $v){
                //应获得金额
                $due_money=round($v->zyl_num*$release_interest,2);
                //当前与最大的差值
                $d_money=$v->zyl_num-$v->release_money;
                //还有可获得的数量
                if($d_money>0){
                    if($d_money>$due_money){
                        $release_money=$due_money;
                    }else{
                        $release_money=$d_money;
                    }
                    Matching::where('id',$v->id)->increment('release_money',$release_money);
                    Account::where('user_id',$v->user_id)->increment('zyl_money',$release_money);
                    $release_add[$i]=['user_id'=>$v->user_id,'money'=>$release_money,'created_at'=>$time,'updated_at'=>$time];
                    $i++;
                //金额已全部获得    
                }else{
                    Matching::where('id',$v->id)->update(['state'=>2]);
                }
            }
            Release::insert($release_add);
        }




        return $this->success('结算成功');
    }

    //获取静态收益阶梯利率
    public function static_interest($money,$interest_data){
        $interest=0;
        foreach($interest_data as $k => $v){
            if($v['money']<=$money){
                $interest=$v['interest'];
            }else{
                break;
            }
        }
        return $interest;
    }

    //会员日志查看
    public function user_log(){
        return view('admin.assist.user_log');
    }
    //获取会员日志
    public function get_user_log(Request $request){
        $count=UserLog::count();
        $page=$this->my_page($request, $count);
        $user_log=UserLog::offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->with('user')->get();
        $data=[];
        foreach($user_log as $k => $v){
            $data[$k]['username']=optional($v->user)->username.'【'.optional($v->user)->name.'】';
            $data[$k]['ip']=$v->ip;
            $data[$k]['created_at']=$v->created_at->toDateTimeString();
            $data[$k]['note']=$v->type==1?'会员登录系统':'';
        }
        return $this->json_data($data,$count);
    }

    //管理员日志查看
    public function admin_log(){
        return view('admin.assist.admin_log');
    }

    //获取管理员日志
    public function get_admin_log(Request $request){
        $count=AdminLog::count();
        $page=$this->my_page($request, $count);
        $admin_log=AdminLog::offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->with('admin_user')->get();
        $data=[];
        foreach($admin_log as $k => $v){
            $data[$k]['username']=optional($v->admin_user)->username;
            $data[$k]['ip']=$v->ip;
            $data[$k]['created_at']=$v->created_at->toDateTimeString();
            $data[$k]['note']=$v->type==1?'管理员登录系统':'';
        }
        return $this->json_data($data,$count);
    }

    //数据导入
    public function import(){
        return view('admin.assist.import');
    }

}

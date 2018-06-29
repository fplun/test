<?php
//财务模块
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Account;
use App\Models\Detailed;
use App\Models\AdminUser;
use App\Models\Profit;
use App\Models\Recharge;
use App\Models\Extract;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class FinanceController extends Controller
{
    //
    public function index()
    {
    }

    //补贴列表
    public function subsidy_list()
    {
        return view('admin.finance.subsidy_list');
    }

    public function get_subsidy_list(Request $request){
        $user_where=[];
        $time_where=[];
        if ($request->acc) {
            $user_where[]=['username','=',$request->acc];
        }
        if ($request->start) {
            $time_where[]=['created_at','>=',$request->start];
        }
        if ($request->end) {
            $end_time=date('Y-m-d', (strtotime($request->end)+86400));
            $time_where[]=['created_at','<',$end_time];
        }
        
        $count=Profit::where($time_where)->whereHas('user', function ($query) use ($user_where) {
            $query->where($user_where);
        })->count();
        $page=$this->my_page($request, $count);
        $profit=Profit::where($time_where)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->whereHas('user', function ($query) use ($user_where) {
            $query->where($user_where);
        })->get();
        $data=[];
        foreach ($profit as $k => $v) {
            $data[$k]['username']=$v->user->username;
            $data[$k]['name']=$v->user->name;
            $data[$k]['money']=$v->money;
            $data[$k]['state']=$v->state==1?'已转换':'未转换';
            $data[$k]['type']=$v->type==1?'动态收益':'静态收益';
            $data[$k]['created_at']=$v->created_at->toDateString();
        }

        return $this->json_data($data,$count);
    }

    //维护列表 赠送会员抵扣币  注册币
    public function maintain_list()
    {
        return view('admin.finance.maintain_list');
    }

    //获取会员列表
    public function get_maintain_list(Request $request){
        $user_where=[];
        if ($request->acc) {
            $user_where[]=['username','=',$request->acc];
        }
        if ($request->start) {
            $user_where[]=['created_at','>=',$request->start];
        }
        if ($request->end) {
            $end_time=date('Y-m-d', (strtotime($request->end)+86400));
            $user_where[]=['created_at','<',$end_time];
        }

        $count=User::where('state',1)->where($user_where)->count();
        $page=$this->my_page($request, $count);
        $user=User::where('state',1)->where($user_where)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->with('account')->get();
        $data=[];
        foreach($user as $k => $v){
            $data[$k]['id']=$v->id;
            $data[$k]['username']=$v->username;
            $data[$k]['name']=$v->name;
            $data[$k]['zyl_money']=optional($v->account)->zyl_money;
            $data[$k]['agio']=optional($v->account)->agio;
            $data[$k]['register']=optional($v->account)->register;
            $data[$k]['created_at']=$v->created_at->toDateString();
        }
        return $this->json_data($data,$count);
    }
    //会员赠送管理
    public function recharge(Request $request){
        $type=$request->type;
        $id=$request->id;
        return view('admin.finance.recharge')->with('type',$type)->with('id',$id);
    }
    //赠送用户抵扣币  和注册币
    public function recharge_make(Request $request){
        if($request->type==1){
            $type="agio";
            $detailed_type=2;
        }else if($request->type==2){
            return;
            $type="register";
        }else if($request->type==3){
            $type="zyl_money";
            $detailed_type=12;
        }
        $admin_id = $request->session()->get('admin_id');
        $admin=AdminUser::where('id',$admin_id)->first();
        $account=Account::where('user_id',$request->id)->first();
        DB::beginTransaction();
        try{
            $detailed=new Detailed;
            $detailed->user_id=$account->user_id;
            $detailed->change=$request->money;
            $detailed->balance=$account->$type;
            $detailed->type=$detailed_type;
            $detailed->admin=$admin->username;
            $detailed->money_type=0;
            $detailed->save();

            $account->$type=$account->$type+$request->money;
            $account->save();

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return $this->error('充值失败');
        }

        return $this->success('充值成功');
    }

    //充值列表
    public function recharges_list()
    {
        return view('admin.finance.recharges_list');
    }

    public function get_recharges_list(Request $request){
        $user_where=[];
        $time_where=[];
        if ($request->acc) {
            $user_where[]=['username','=',$request->acc];
        }
        if ($request->start) {
            $time_where[]=['created_at','>=',$request->start];
        }
        if ($request->end) {
            $end_time=date('Y-m-d', (strtotime($request->end)+86400));
            $time_where[]=['created_at','<',$end_time];
        }

        $count=Recharge::where($time_where)->whereHas('user', function ($query) use ($user_where) {
            $query->where($user_where);
        })->count();
        $page=$this->my_page($request, $count);
        $recharge=Recharge::where($time_where)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->whereHas('user', function ($query) use ($user_where) {
            $query->where($user_where);
        })->get();
        $data=[];
        foreach($recharge as $k=>$v){
            $data[$k]['id']=$v->id;
            $data[$k]['username']=$v->user->username;
            $data[$k]['money']=$v->money;
            $data[$k]['created_at']=$v->created_at->toDateTimeString();
            $data[$k]['handle_at']=$v->handle_at;
            $data[$k]['voucher']=$v->voucher;
            $data[$k]['state']=$this->recharge_state($v->state);
            $data[$k]['no_pass']=$v->no_pass;
        }

        return $this->json_data($data,$count);
    }
    public function recharge_state($state){
        if($state==0){
            $str='未处理';
        }else if($state==1){
            $str='审核通过';
        }else if($state==2){
            $str='未通过';
        }

        return $str;
    }

    //充值不通过页面
    public function recharge_no_pass(){
        return view('admin.finance.recharge_no_pass');
    }
    //充值通过不通过操作
    public function recharge_handle(Request $request){
        $recharge=Recharge::where('id',$request->id)->where('state',0)->first();
        if(empty($recharge)){
            return $this->error('没有该订单');
        }
        //状态判断
        if($request->state==1){
            $recharge->state=1;
            $account=Account::where('user_id',$recharge->user_id)->first();
            $admin_id = $request->session()->get('admin_id');
            $admin=AdminUser::where('id',$admin_id)->first();
        }else if($request->state==2){
            if(empty($request->no_pass)){
                return $this->error('请输入不通过原因');
            }
            $recharge->no_pass=$request->no_pass;
            $recharge->state=2;
        }else{
            return $this->error('传入状态错误');
        }
        
        DB::beginTransaction();
        try{

            $recharge->handle_at=date('Y-m-d H:i:s',time());
            $recharge->save();
            //通过用户注册币增加
            
            if($request->state==1){
                $detailed=new Detailed;
                $detailed->user_id=$recharge->user_id;
                $detailed->change=$recharge->money;
                $detailed->balance=$account->register;
                $detailed->type=1;
                $detailed->admin=$admin->username;
                $detailed->money_type=0;
                $detailed->save();
                $account->register=$account->register+$recharge->money;
                $account->save();
            }
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return $this->error('审批失败');
        }

        return $this->success('审批成功');
    }

   

    //账户明细列表
    public function detailed_list()
    {
        return view('admin.finance.detailed_list');
    }

    //获取账户明细
    public function get_detailed_list(Request $request)
    {
        $user_where=[];
        $detailed_where=[];
        if ($request->acc) {
            $user_where[]=['username','=',$request->acc];
        }
        if ($request->start) {
            $detailed_where[]=['created_at','>=',$request->start];
        }
        if ($request->end) {
            $end_time=date('Y-m-d', (strtotime($request->end)+86400));
            $detailed_where[]=['created_at','<',$end_time];
        }

        $count=Detailed::where($detailed_where)->count();
        $page=$this->my_page($request, $count);
        $detailed=Detailed::where($detailed_where)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->whereHas('user', function ($query) use ($user_where) {
            $query->where($user_where);
        })->get();
        $data=[];
        foreach($detailed as $k => $v){
            $data[$k]['username']=$v->user->username;
            $data[$k]['name']=$v->user->name;
            $data[$k]['change']=$v->change;
            $data[$k]['balance']=$v->balance;
            $data[$k]['type']=$this->detailed_type($v->type);
            $data[$k]['money_type']=$v->money_type==0?'增加':'减少';
            $data[$k]['created_at']=empty($v->created_at)?'':$v->created_at->toDateTimeString();
        }
        return $this->json_data($data,$count);
    }

    public function detailed_type($type){
        $type_array=[
            1=>"注册币充值",
            2=>"赠送抵扣币",
            3=>"会员转账减少",
            4=>"会员转账增加",
            5=>"收益转为众易链币",
            6=>"",
            7=>"交易获得注册币",
            8=>"交易失去注册币",
            9=>"交易获得抵扣币",
            10=>"交易失去抵扣币",
            11=>"锁仓失去注册币",
            12=>'赠送众易链',
        ];
        return $type_array[$type];
    }

    //拨出率统计
    public function bonus_list()
    {
        return view('admin.finance.bonus_list');
    }

    //提币列表

    public function extracts(){
        return view('admin.finance.extracts');
    }

    public function get_extracts(Request $request){
        $user_where=[];
        $detailed_where=[];
        if ($request->acc) {
            $user_where[]=['username','=',$request->acc];
        }
        if ($request->start) {
            $detailed_where[]=['created_at','>=',$request->start];
        }
        if ($request->end) {
            $end_time=date('Y-m-d', (strtotime($request->end)+86400));
            $detailed_where[]=['created_at','<',$end_time];
        }

        $count=Extract::where($detailed_where)->count();
        $page=$this->my_page($request, $count);
        $list=Extract::where($detailed_where)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->whereHas('user', function ($query) use ($user_where) {
            $query->where($user_where);
        })->get();
        $data=[];
        foreach($list as $k=>$v){
            $data[$k]['id']=$v->id;
            $data[$k]['username']=$v->user->username;
            $data[$k]['type']=$v->type==1?'以太坊钱包':'众易链钱包';
            $data[$k]['address']=$v->address;
            $data[$k]['all_money']=$v->all_money;
            $data[$k]['money']=$v->money;
            $data[$k]['consume']=$v->consume;
            $data[$k]['interest']=$v->interest;
            $data[$k]['handle_at']=$v->handle_at;
            $data[$k]['no_pass']=$v->no_pass;
            if($v->state==0){
                $data[$k]['state']='未处理';
            }else if($v->state==1){
                $data[$k]['state']='已处理';
            }else if($v->state==2){
                $data[$k]['state']='未通过';
            }
            $data[$k]['created_at']=$v->created_at->toDateTimeString();
        }
        return $this->json_data($data,$count);
    }


    public function extracts_make(Request $request){

        $extract=Extract::where('id',$request->id)->where('state',0)->first();
        if(empty($extract)){
            return $this->error('没有找到该订单');
        }

        if($request->state==1){
            $state=1;
        }else if($request->state==2){
            $state=2;
        }else{
            return $this->error('传入状态错误');
        }
        $account=Account::where('user_id',$extract->user_id)->first();


        DB::beginTransaction();

        try{
            if($state==1){
                //通过消费积分增加
                $account->consume=$account->consume+$extract->consume;
                //通过记录详情
                /* $detailed_add=[];
                Detailed::insert($detailed_add); */
            }else if($state==2){
                $extract->no_pass=$request->no_pass;
                //不通过金额返还
                $account->zyl_money=$account->zyl_money+$extract->all_money;
                
            }
            $account->save();
            $extract->state=$state;
            $extract->handle_at=date('Y-m-d H:i:s',time());
            $extract->save();
            
            DB::commit();
        }catch(QueryException $ex){
            DB::rollback();
            return $this->error('失败');
        }
        return $this->success('成功');

    }
}

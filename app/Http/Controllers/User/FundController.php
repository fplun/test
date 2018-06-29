<?php

namespace App\Http\Controllers\User;

use App\Models\Recharge;
use App\Models\Profit;
use App\Models\Account;
use App\Models\Detailed;
use App\Models\User;
use App\Models\Deal;
use App\Models\Set;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function tofxbt()
    {
        return view('user.fund.tofxbt');
    }
    //获取每日收益
    public function get_tofxbt(Request $request){
        $limit = $request->input('limit', 10);
        $count=Profit::where('user_id', $request->user->id)->count();
        $list = Profit::where('user_id', $request->user->id)->paginate();
        $data=[];
        foreach($list as $k=>$v){
            $data[$k]['money']=$v->money;
            $data[$k]['created_at']=$v->created_at->toDateString();
            $data[$k]['state']=$v->state;
            $data[$k]['type']=$v->type==0?__('静态收益'):__('动态收益');
        }

        return response()->json([
            'code' => 0,
            'count' => $count,
            'data' => $data,
            'msg' => '',
        ]);
    }

    public function remittance(Request $request, Recharge $recharge)
    {
        $user = $request->user;
        if ($request->isMethod('get')) {
            $recharge_address=Set::where('set_type','recharge_address')->first()->details;
            $recharge_address=json_decode($recharge_address,1);
            return view('user.fund.remittance', compact('user'))->with('recharge_address',$recharge_address[0]);
        }
        $this->validate($request, [
            'money' => 'required',
            'img' => 'required|image',
            'sec_password' => 'required',
        ]);
        if (!Hash::check($request->sec_password, $request->user->sec_password)) {
            return back()->withErrors(['安全密码错误']);
        }
        $recharge->user_id = $request->user->id;
        $recharge->money = $request->money;
        $recharge->voucher = $this->uploadImage($request, 'img');
        $recharge->save();

        return back()->with('message', '提交成功');
    }

    public function remittancelist(Request $request)
    {
        return view('user.fund.remittancelist');
    }

    public function rechargeListJson(Request $request)
    {
        $limit = $request->input('limit', 10);
        $list = Recharge::where('user_id', $request->user->id)->orderBy('id', 'desc')->paginate($limit);
        return $this->responseList($list);
    }

    public function tozcsy(Request $request)
    {
        return view('user.fund.tozcsy');
    }

    public function transfernbzz(Request $request)
    {
        $zyl_price=Set::where('set_type','zyl_price')->first()->details;
        $static_profit=Profit::where('user_id',$request->user->id)->where('state',0)->where('type',0)->sum('money');
        $dynamic_profit=Profit::where('user_id',$request->user->id)->where('state',0)->where('type',1)->sum('money');
        return view('user.fund.transfernbzz')->with('static_profit',$static_profit)->with('dynamic_profit',$dynamic_profit)->with('zyl_price',$zyl_price);
    }
    //用户收益转换操作
    public function profit_transform(Request $request){
        if(!Hash::check($request->sec_password,$request->user->sec_password)){
            return back()->with('message','安全密码错误');
        }

        $profit_money=Set::where('set_type','zyl_price')->first()->details;
        if($profit_money!='on'){
            return back()->with('message','算力转换目前未开放');
        }
        
        $profit_where=[];
        if($request->type==0){
            $profit_where=[['type','=',0]];
        }else if($request->type==1){
            $profit_where=[['type','=',1]];
        }else if($request->type==2){

        }   
        $profit_sum=Profit::where($profit_where)->where('state',0)->where('user_id',$request->user->id)->sum('money');
        if($profit_sum<=0){
            return back()->with('message','可转换收益不足');
        }
        $account=Account::where('user_id',$request->user->id)->first();
        $zyl_price=Set::where('set_type','zyl_price')->first()->details;

        $zyl_num=round($profit_sum/$zyl_price,2);
        DB::beginTransaction();
        try{
            Profit::where($profit_where)->where('state',0)->where('user_id',$request->user->id)->update(['state'=>1]);

            $detailed=new Detailed;
            $detailed->user_id=$request->user->id;
            $detailed->change=$zyl_num;
            $detailed->balance=$account->zyl_money;
            $detailed->type=5;
            $detailed->money_type=0;
            $detailed->save();

            $account->zyl_money=$account->zyl_money+$zyl_num;
            $account->save();

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('message','转换失败');
        }

        return back()->with('message','转换成功');
    }

    public function transfer(Request $request)
    {
        $account=Account::where('user_id',$request->user->id)->first();
        return view('user.fund.transfer')->with('account',$account);
    }

    //会员转账交易操作
    public function deal_make(Request $request){
        $this->validate($request, [
            'username' => 'required|exists:users',
            'money'=>'required|integer|min:1',
            'type'=>'required|integer|min:0|max:1'
        ]);
        if(!Hash::check($request->sec_password,$request->user->sec_password)){
            return back()->with('message','安全密码错误');
        }
        $account=Account::where('user_id',$request->user->id)->first();
        if($request->type==0){
            $money_type='register';
            $sell_type=8;
            $buy_type=7;
        }else if($request->type==1){
            $money_type='agio';
            $sell_type=10;
            $buy_type=9;
        }
        if($account->$money_type<$request->money){
            return back()->with('message','当前金额不足');
        }

        //查询收款用户
        $buy_user=User::where('username',$request->username)->first();
        $buy_account=Account::where('user_id',$buy_user->id)->first();

        DB::beginTransaction();
        $time=date('Y-m-d H:i:s',time());
        try{
            //生成订单
            $deal=new Deal;
            $deal->sell_id=$request->user->id;
            $deal->buy_id=$buy_user->id;
            $deal->money=$request->money;
            $deal->type=$request->type;
            $deal->save();
            //添加  买方和卖方的  金额变化记录  
            $detailed_add=[['user_id'=>$request->user->id,'change'=>$request->money,'balance'=>$account->$money_type,'type'=>$sell_type,'money_type'=>1,'created_at'=>$time,'updated_at'=>$time],
            ['user_id'=>$buy_user->id,'change'=>$request->money,'balance'=>$buy_account->$money_type,'type'=>$buy_type,'money_type'=>0,'created_at'=>$time,'updated_at'=>$time]];
            Detailed::insert($detailed_add);

            //改变账户金额
            $account->$money_type=$account->$money_type-$request->money;
            $account->save();

            $buy_account->$money_type=$buy_account->$money_type+$request->money;
            $buy_account->save();
            
            DB::commit();
        }catch (QueryException $ex){
            DB::rollBack();
            return back()->with('message','转帐失败');
        }
        return back()->with('message','转帐成功');
    }

    public function transferlist(Request $request)
    {
        return view('user.fund.transferlist');
    }

    public function get_transferlist(Request $request){
        $limit = $request->input('limit', 10);
        $count=Deal::where(function ($query) use ($request){
            $query->where('sell_id',$request->user->id)->orWhere('buy_id',$request->user->id);
        })->count();

        $deal=Deal::where(function ($query) use ($request){
            $query->where('sell_id',$request->user->id)->orWhere('buy_id',$request->user->id);
        })->with('sell_user')->with('buy_user')->paginate();
        $data=[];
        foreach($deal as $k => $v){
            $data[$k]['sell_username']=$v->sell_user->username;
            $data[$k]['buy_username']=$v->buy_user->username;
            $data[$k]['money']=$v->money;
            $data[$k]['type']=$v->type;
            $data[$k]['created_at']=$v->created_at->toDateTimeString();
        }

        return response()->json([
            'code' => 0,
            'count' => $count,
            'data' => $data,
            'msg' => '',
        ]);
    }
}

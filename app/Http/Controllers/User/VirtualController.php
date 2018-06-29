<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Extract;
use App\Models\Set;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class VirtualController extends Controller
{
    public function tozylmx(Request $request)
    {
        return view('user.virtual.tozylmx');
    }

    public function togzyl(Request $request)
    {
        $set['zyl_price']=Set::where('set_type', 'zyl_price')->first()->details;
        $account=Account::where('user_id', $request->user->id)->first();
        return view('user.virtual.togzyl')->with('account', $account)->with('set', $set);
    }

    public function turn_money(Request $request)
    {
        $this->validate($request, [
            'money' => 'required|integer|min:100',
            'sec_password'=>'required'
        ]);

        if($request->money%100!=0){
            return back()->with('message', '转换金额为100的倍数');
        }

        if (!Hash::check($request->sec_password, $request->user->sec_password)) {
            return back()->with('message', '安全密码错误');
        }
        

        $zyl_price=Set::where('set_type', 'zyl_price')->first()->details;
        $money_change=Set::where('set_type', 'money_change')->first()->details;
        $money_change=json_decode($money_change,1);
        if ($request->out_type==1) {
            $out_type='zyl_money';
            $money=$request->money*$zyl_price;
            if ($request->in_type==1) {
                if($money_change['zyl_register']!='on'){
                    return back()->with('message', '该转换暂未开放');
                }
                $in_type='register';
            } else {
                return back()->with('message', '转入类型错误');
            }
        } elseif ($request->out_type==2) {
            $out_type='register';
            $money=$request->money;
            if ($request->in_type==2) {
                if($money_change['register_agio']!='on'){
                    return back()->with('message', '该转换暂未开放');
                }
                $in_type='agio';
            } else {
                return back()->with('message', '转入类型错误');
            }
        } elseif ($request->out_type==3) {
            $out_type='consume';
            $money=$request->money*$zyl_price;
            if ($request->in_type==2) {
                if($money_change['consume_agio']!='on'){
                    return back()->with('message', '该转换暂未开放');
                }
                $in_type='agio';
            } else {
                return back()->with('message', '转入类型错误');
            }
        } else {
            return back()->with('message', '转出类型错误');
        }

        $account=Account::where('user_id',$request->user->id)->first();
        if($request->money>$account->$out_type){
            return back()->with('message', '当前余额不足');
        }
        DB::beginTransaction();
        try{
            $account->$out_type=$account->$out_type-$request->money;
            $account->$in_type=$account->$in_type+$money;
            $account->save();
            DB::commit();
        }catch(QueryException $ex){
            DB::rollback();
            return back()->with('message', '转换失败');
        }   
        return back()->with('message', '转换成功');
    }

    public function whitdraw(Request $request)
    {
        $account=Account::where('user_id', $request->user->id)->first();
        $extracts_interest=Set::where('set_type', 'extracts_interest')->first()->details;
        $extracts_interest=json_decode($extracts_interest, 1);
        return view('user.virtual.whitdraw')->with('account', $account);
    }

    public function extracts_make(Request $request)
    {
        $extracts_num=Set::where('set_type', 'extracts_num')->first()->details;
        $extracts_num=json_decode($extracts_num, 1);

        $this->validate($request, [
            'address'=>'required',
            'money' => 'required|integer|min:'.$extracts_num['min'],
            'type'=>'required'
        ]);
        
        if ($request->money%$extracts_num['times']!=0) {
            return back()->with('message', '请提取'.$extracts_num['times'].'的倍数');
        }

        if (!Hash::check($request->sec_password, $request->user->sec_password)) {
            return back()->with('message', '安全密码错误');
        }

        $account=Account::where('user_id', $request->user->id)->first();

        if ($account->zyl_money<$request->money) {
            return back()->with('message', '账户当前数量不足');
        }

        $extracts_interest=Set::where('set_type', 'extracts_interest')->first()->details;
        $extracts_interest=json_decode($extracts_interest, 1);

        DB::beginTransaction();
        try {
            $extract=new Extract;
            $extract->user_id=$request->user->id;
            $extract->type=$request->type;
            $extract->address=$request->address;
            $extract->all_money=$request->money;
            $extract->consume=round($request->money*$extracts_interest['consume']/100, 2);
            $extract->money=round($request->money*$extracts_interest['wallect']/100, 2);
            $extract->interest=round($request->money*$extracts_interest['interest']/100, 2);
            $extract->save();

            $account->zyl_money=$account->zyl_money-$request->money;
            $account->save();

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('message', '订单创建失败');
        }
        return back()->with('message', '订单创建成功');
    }

    public function whitdrawlist(Request $request)
    {
        return view('user.virtual.whitdrawlist');
    }
    
    public function get_whitdrawlist(Request $request)
    {
        $limit = $request->input('limit', 10);
        $count=Extract::where('user_id', $request->user->id)->count();
        $list = Extract::where('user_id', $request->user->id)->paginate();
        $data=[];
        foreach ($list as $k => $v) {
            $data[$k]['type']=$v->type==1?'以太坊钱包':'众易链钱包';
            $data[$k]['address']=$v->address;
            $data[$k]['all_money']=$v->all_money;
            $data[$k]['no_pass']=$v->no_pass;
            if ($v->state==0) {
                $data[$k]['state']='未处理';
            } elseif ($v->state==1) {
                $data[$k]['state']='已处理';
            } elseif ($v->state==2) {
                $data[$k]['state']='未通过';
            }
            $data[$k]['created_at']=$v->created_at->toDateTimeString();
            $data[$k]['consume']=$v->consume;
            $data[$k]['money']=$v->money;
            $data[$k]['interest']=$v->interest;
        }

        return response()->json([
            'code' => 0,
            'count' => $count,
            'data' => $data,
            'msg' => '',
        ]);
    }
}

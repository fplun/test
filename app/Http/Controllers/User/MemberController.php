<?php

namespace App\Http\Controllers\User;

use App\Models\Account;
use App\Models\Detailed;
use App\Models\Matching;
use App\Models\Node;
use App\Models\Set;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function userreg(Request $request)
    {
        if ($request->isMethod('get')) {
            $username = 'CN' . mt_rand(11111111, 99999999);
            $user = $request->user;
            $top_user = $request->query('top_uid');
            $position = $request->query('position');

            return view('user.member.userreg', compact('username', 'user', 'top_user', 'position'));
        }
        $this->validate($request, [
            'username' => 'required|min:6|max:25|unique:users',
            'password' => 'required|min:6|max:25',
            'sec_password' => 'required|min:6|max:25',
            /* 'name' => 'required|max:25', */
            // 'phone' => ['required', 'unique:users', 'regex:/^((13[0-9])|(15[^4])|(166)|(17[0-8])|(18[0-9])|(19[8-9])|(147)|(145))\\d{8}$/'],
            'email' => 'required|email',
            /* 'extract_type' => 'required',
            'extract_address' => 'required', */
            'recommend' => 'required|exists:users,username',
            'contact' => 'required|exists:users,username',
            'position' => 'required|digits_between:1,2',
            'money' => 'required|min:100|integer',
        ]);

        if($request->money%100!=0){
            return back()->withErrors(['投资金额为100的倍数']);
        }
        $recommend_user = User::where('username', $request->recommend)->select('id')->first();

        //接点人金额  位置判断
        $contact_user = User::where('username', $request->contact)->select('id')->first();
        
        $contact_node = Node::where('level', 1)->where('top_id', $contact_user->id)->where('type', $request->position)->first();
        if (!empty($contact_node)) {
            return back()->withErrors(['该位置已经有注册用户']);
        }
        //查询所有上级
        $all_node = Node::where('user_id', $contact_user->id)->orderBy('top_id', 'desc')->get();

        $password = bcrypt($request->password);
        $sec_password = bcrypt($request->sec_password);
        $time=date('Y-m-d H:i:s',time());
        DB::beginTransaction();
        try {
            
            $user = new User();
            $user->username = $request->username;
            $user->password = $password;
            $user->sec_password = $sec_password;
            $user->name = '';
            $user->phone = '';
            $user->email = $request->email;
            $user->recommend_id = $recommend_user->id;
            $user->register_money=$request->money;
            $user->register_type=$request->user->id;
            $user->save();
            
            //创建接点表
            $node_add[0] = ['user_id' => $user->id, 'top_id' => $contact_user->id, 'type' => $request->position, 'level' => 1,'created_at'=>$time,'updated_at'=>$time];
            foreach ($all_node as $k => $v) {
                $node_add[$k + 1] = ['user_id' => $user->id, 'top_id' => $v->top_id, 'type' => $v->type, 'level' => $k + 2,'created_at'=>$time,'updated_at'=>$time];
            }
            Node::insert($node_add);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->withErrors(['注册失败']);
        }

        return back()->withMessage('注册成功,请到激活页面激活用户');

    }



    public function recmlists(Request $request)
    {
        $user = $request->user;
        return view('user.member.recmlists', compact('user'));
    }

    public function recommendListJson(Request $request)
    {
        $limit = $request->input('limit', 10);

        $count=User::where('register_type', $request->user->id)->where('state',0)->count();
        $list = User::where('register_type', $request->user->id)->where('state',0)->paginate();
        $data=[];
        foreach ($list as $k =>$v) {
            $data[$k]['id']=$v->id;
            $data[$k]['username']=$v->username;
            $data[$k]['name']=$v->name;
            $data[$k]['register_money']=$v->register_money;
            $data[$k]['created_at']=$v->created_at->toDateTimeString();
        }


        return response()->json([
            'code' => 0,
            'count' => $count,
            'data' => $data,
            'msg' => '',
        ]);
    }
    //删除未激活用户
    public function delete_no_open(Request $request){
        $user=User::where('id',$request->id)->where('state',0)->where('register_type',$request->user->id)->first();
        if(empty($user)){
            return $this->error('没有该用户');
        }
        DB::beginTransaction();
        try {
            $user->delete();
            Node::where('user_id',$user->id)->delete();
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return $this->error('删除失败');
        }
        return $this->success('成功');
    }

    public function jihuo_no_open(Request $request){
        $user=User::where('id',$request->id)->where('state',0)->where('register_type',$request->user->id)->first();
        if(empty($user)){
            return $this->error('没有该用户');
        }
        $matching_day = Set::where('set_type', 'matching_day')->first()->details;
        $zyl_price = Set::where('set_type', 'zyl_price')->first()->details;
        $agio_interest = Set::where('set_type', 'agio_interest')->first()->details;
        $node=Node::where('user_id',$user->id)->where('level',1)->first();

        $top_account = Account::where('user_id', $user->recommend_id)->first();
        //抵扣币最大数量
        if($request->state==1){
            if($top_account->register<$user->register_money){
                return $this->error('推荐人激活币不足');
            }
        }else{
            $max_agio=round($user->register_money*($agio_interest)/100,2);
            if($max_agio<=$top_account->agio){
                $end_agio=$max_agio;
            }else{
                $end_agio=$top_account->agio;
            }
            $end_register=$user->register_money-$end_agio;
            if($top_account->register<$end_register){
                return $this->error('推荐人激活币不足');
            }
        }
            

        DB::beginTransaction();
        try {
            //接点用户金额减少
            if($node){
                if($request->state==1){
                    $top_account->register=$top_account->register-$user->register_money;
                }else{
                    $top_account->register=$top_account->register-$end_register;
                    $top_account->agio=$top_account->agio-$end_agio;
                }
                $top_account->save();
            }

            $user->state = 1;
            $res = $user->save();

            $matching = new Matching;
            $matching->user_id = $request->id;
            $matching->money = $user->register_money;
            $matching->lock_day = $matching_day;
            $matching->price = $zyl_price;
            $matching->zyl_num=round($user->register_money/$zyl_price,2);
            $matching->end_at = date('Y-m-d H:i:s', time() + ($matching_day * 86400));
            $matching->save();

            $account = new Account();
            $account->user_id = $user->id;
            $account->save();

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return $this->error('激活失败');
        }
        return $this->success('成功');
    }

    public function useraudio()
    {
        return view('user.member.useraudio');
    }

    //增加配套 （锁仓）
    public function tctz(Request $request)
    {
        $matching_day = Set::where('set_type', 'matching_day')->first()->details;
        $zyl_price = Set::where('set_type', 'zyl_price')->first()->details;
        $account = Account::where('user_id', $request->user->id)->first();
        return view('user.member.tctz')->with('user', $request->user)->with('matching_day', $matching_day)->with('zyl_price', $zyl_price)->with('account', $account);
    }

    //添加配套操作  （锁仓）操作
    public function lock_add(Request $request)
    {
        $this->validate($request, [
            'money' => 'required|integer|min:100',
        ]);
        if ($request->money % 100 != 0) {
            return back()->with('message', '请输入100的倍数');
        }
        $account = Account::where('user_id', $request->user->id)->first();

        if ($account->register < $request->money) {
            return back()->with('message', '账户当前余额不足');
        }
        $matching_day = Set::where('set_type', 'matching_day')->first()->details;
        $zyl_price = Set::where('set_type', 'zyl_price')->first()->details;

        DB::beginTransaction();
        try {

            $matching = new Matching;
            $matching->user_id = $request->user->id;
            $matching->money = $request->money;
            $matching->price = $zyl_price;
            $matching->zyl_num = round($request->money / $zyl_price, 2);
            $matching->lock_day = $matching_day;
            $matching->end_at = date('Y-m-d H:i:s', time() + $matching_day * 86400);
            $matching->save();

            $detailed = new Detailed;
            $detailed->user_id = $account->user_id;
            $detailed->change = $request->money;
            $detailed->balance = $account->register;
            $detailed->type = 11;
            $detailed->money_type = 1;
            $detailed->save();

            $account->register = $account->register - $request->money;
            $account->save();

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('message', '锁仓失败');
        }
        return back()->with('message', '锁仓成功');
    }

    public function taochan()
    {
        return view('user.member.taochan');
    }
    //获取配套管理
    public function get_taochan(Request $request)
    {
        $limit = $request->input('limit', 10);
        $count = Matching::where('user_id', $request->user->id)->count();
        $list = Matching::where('user_id', $request->user->id)->paginate();
        $data = [];
        foreach ($list as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['money'] = $v->money;
            $data[$k]['last_day'] = ($v->lock_day - $v->created_at->diffInDays()) < 0 ? 0 : $v->lock_day - $v->created_at->diffInDays();
            $data[$k]['created_at'] = $v->created_at->toDateTimeString();
            $data[$k]['price'] = $v->price;
            $data[$k]['zyl_num'] = $v->zyl_num;
            $data[$k]['release_money'] = $v->release_money;
            if ($v->state == 0) {
                if ($data[$k]['last_day'] == 0) {
                    $data[$k]['release_state'] = 1;
                }
                $data[$k]['state'] = __('锁仓中');
            } else if ($v->state == 1) {
                $data[$k]['state'] = __('解锁释放');
            } else if ($v->state == 2) {
                $data[$k]['state'] = __('释放完成');
            }
        }

        return response()->json([
            'code' => 0,
            'count' => $count,
            'data' => $data,
            'msg' => '',
        ]);
    }

    //
    public function release_lock(Request $request)
    {
        $time = date('Y-m-d H:i:s', time());
        $matching = Matching::where('id', $request->id)->where('user_id', $request->user->id)->where('state', 0)->whereDate('end_at', '<', $time)->first();
        if (empty($matching)) {
            return $this->error(__('没有找到该订单'));
        }

        $matching->state = 1;
        $matching->release_at = $time;
        $res = $matching->save();
        if ($res) {
            return $this->success(__('成功'));
        } else {
            return $this->error(__('释放失败'));
        }
    }

   

    public function networkDiagram(Request $request)
    {
        if($request->username){
            $s_user=User::where('username',$request->username)->first();
            if(empty($s_user)){
                return back()->with('message', '没有该用户');
            }
            $username=$request->username;
            $s_count=Node::where('top_id',$request->user->id)->whereHas('user', function ($query) use ($username) {
                $query->where('username',$username);
            })->count();
            if($request->username!=$request->user->username){
                if($s_count<1){
                    return back()->with('message', '该会员不是你的下级不可查看');
                }
            }
            $user = $s_user;
        }else{
            $user = $request->user;
        }
        //查询业绩
        $user_ac=User::where('id',$user->id)->with('dynamic_user')->select('id')->first();
        $user->A=0;
        $user->B=0;
        $user->A_count=0;
        $user->B_count=0;
        foreach($user_ac['dynamic_user'] as $node_v){
            if($node_v->type==1){
                $user->A_count+=1;
            }else if($node_v->type==2){
                $user->B_count+=1;
            }
            foreach($node_v['dynamic_matching'] as $matching_v){
                if($node_v->type==1){
                    $user->A+=$matching_v->money;
                }else if($node_v->type==2){
                    $user->B+=$matching_v->money;
                }
            }
        }

        $uids = Node::where('top_id', $user->id)->where('level', '<', 4)->pluck('user_id');
        $nodes = Node::with('user')->with('dynamic_node')->whereIn('user_id', $uids ?: [])->where('level', 1)->get();


        $list = [];
        foreach ($nodes as $node) {
            $node->A=0;
            $node->B=0;
            $node->A_count=0;
            $node->B_count=0;
            //下级用户
            foreach($node['dynamic_node'] as $node_v){
                if($node_v->type==1){
                    $node->A_count+=1;
                }else if($node_v->type==2){
                    $node->B_count+=1;
                }
                foreach($node_v['dynamic_matching'] as $matching_v){
                    if($node_v->type==1){
                        $node->A+=$matching_v->money;
                    }else if($node_v->type==2){
                        $node->B+=$matching_v->money;
                    }
                }
            }
            $list[$node->top_id . '-' . $node->type] = $node;
        }
        $result = $this->formatTree($list, $user);

        return view('user.member.networkDiagram', compact('result', 'user'));
    }

    protected function formatTree($list, $user)
    {
        $result = [$user, [null, null], [null, null, null, null], [null, null, null, null, null, null, null, null]];
        $result[1][0] = isset($list[$user->id . '-1']) ? $list[$user->id . '-1'] : null;
        $result[1][1] = isset($list[$user->id . '-2']) ? $list[$user->id . '-2'] : null;

        $level1_user = $result[1][0];
        if ($level1_user) {
            $result[2][0] = isset($list[$level1_user->user->id . '-1']) ? $list[$level1_user->user->id . '-1'] : null;
            $result[2][1] = isset($list[$level1_user->user->id . '-2']) ? $list[$level1_user->user->id . '-2'] : null;
        }
        $level1_user = $result[1][1];
        if ($level1_user) {
            $result[2][2] = isset($list[$level1_user->user->id . '-1']) ? $list[$level1_user->user->id . '-1'] : null;
            $result[2][3] = isset($list[$level1_user->user->id . '-2']) ? $list[$level1_user->user->id . '-2'] : null;
        }

        $level2_user = $result[2][0];
        if ($level2_user) {
            $result[3][0] = isset($list[$level2_user->user->id . '-1']) ? $list[$level2_user->user->id . '-1'] : null;
            $result[3][1] = isset($list[$level2_user->user->id . '-2']) ? $list[$level2_user->user->id . '-2'] : null;
        }
        $level2_user = $result[2][1];
        if ($level2_user) {
            $result[3][2] = isset($list[$level2_user->user->id . '-1']) ? $list[$level2_user->user->id . '-1'] : null;
            $result[3][3] = isset($list[$level2_user->user->id . '-2']) ? $list[$level2_user->user->id . '-2'] : null;
        }
        $level2_user = $result[2][2];
        if ($level2_user) {
            $result[3][4] = isset($list[$level2_user->user->id . '-1']) ? $list[$level2_user->user->id . '-1'] : null;
            $result[3][5] = isset($list[$level2_user->user->id . '-2']) ? $list[$level2_user->user->id . '-2'] : null;
        }
        $level2_user = $result[2][3];
        if ($level2_user) {
            $result[3][6] = isset($list[$level2_user->user->id . '-1']) ? $list[$level2_user->user->id . '-1'] : null;
            $result[3][7] = isset($list[$level2_user->user->id . '-2']) ? $list[$level2_user->user->id . '-2'] : null;
        }

        return $result;
    }

    public function recommendList(Request $request)
    {
        // $limit = $request->input('')
    }
}

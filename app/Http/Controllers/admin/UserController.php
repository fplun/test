<?php

namespace App\Http\Controllers\admin;

use App\Models\Account;
use App\Models\Matching;
use App\Models\Node;
use App\Models\Set;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function user_login(Request $request){
        session(['uid' => $request->id]);
        return redirect('/');
    }

    //
    public function register(Request $request)
    {
        $username = $this->get_username();
        $top_username = $request->input('top_uid');
        $position = $request->input('position', 1);
        return view('admin.user.register')
            ->with('username', $username)
            ->with('top_username', $top_username)
            ->with('position', $position);
    }

    public function get_username()
    {
        $username = 'CN' . mt_rand(11111111, 99999999);
        $user = User::where('username', $username)->first();
        if ($user) {
            return $this->get_username();
        } else {
            return $username;
        }
    }

    public function register_make(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required|min:6|max:25|unique:users',
                'password' => 'required|min:6|max:25',
                'sec_password' => 'required|min:6|max:25',
                /* 'name' => 'required|max:25', */
                'email' => 'required|email',
                'position' => 'required|digits_between:1,2',
                'money' => 'required|min:100|integer',
            ],
            [
                'username.required' => '请输入用户编号',
                'username.min' => '用户编号不能小于6位',
                'username.max' => '用户编号不能大于25位',
                'username.unique' => '用户编号已存在',

                'password.required' => '请输入一级密码',
                'password.min' => '一级密码不能小于6位',
                'password.max' => '一级密码不能大于25位',

                'sec_password.required' => '请输入二级密码',
                'sec_password.min' => '二级密码不能小于6位',
                'sec_password.max' => '二级密码不能大于25位',

                'name.required' => '请输入会员姓名',
                'name.max' => '会员姓名不能大于25位',

                'email.required' => '请输入邮箱',
                'email.email' => '邮箱格式错误',

                'position.required' => '请输入接点位置',
                'position.digits_between' => '接点位置格式错误',

                'money.required' => '请输入投资金额',
                'money.min' => '投资金额最低为100',
                'money.integer' => '投资金额格式错误',
            ]
        );

        if($request->money%100!=0){
            return $this->error('投资金额为100的倍数');
        }
        //推荐人判断
        if($request->recommend){
            $recommend_user = User::where('username', $request->recommend)->select('id')->first();
            if(empty($recommend_user)){
                return $this->error('没有该推荐人');
            }
            $recommend_id=$recommend_user->id;
        }else{
            $recommend_id = 0;
        }

        //接点用户判断
        if($request->contact){
            $contact_user = User::where('username', $request->contact)->select('id')->first();
            if(empty($contact_user)){
                return $this->error('没有该接点人');
            }
            $contact_node = Node::where('level', 1)->where('top_id', $contact_user->id)->where('type', $request->position)->first();
            if (!empty($contact_node)) {
                return $this->error('该位置已经有注册用户');
            }
            $all_node = Node::where('user_id', $contact_user->id)->orderBy('top_id', 'desc')->get();
        }

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
            $user->email = $request->email;
            $user->register_money=$request->money;
            $user->recommend_id = $recommend_id;
            $user->save();

            $node_add=[];//节点表默认为空
            if ($request->contact) {
                //创建节点表
                $node_add[0] = ['user_id' => $user->id, 'top_id' => $contact_user->id, 'type' => $request->position, 'level' => 1,'created_at'=>$time,'updated_at'=>$time];
                foreach ($all_node as $k => $v) {
                    $node_add[$k + 1] = ['user_id' => $user->id, 'top_id' => $v->top_id, 'type' => $v->type, 'level' => $k + 2,'created_at'=>$time,'updated_at'=>$time];
                }
            }
            Node::insert($node_add);

            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return $this->error('注册失败');
        }
        return $this->success('注册成功');
    }

    //未开通列表
    public function no_open()
    {
        return view('admin.user.no_open');
    }

    //未开通列表
    public function get_no_open(Request $request)
    {
        $count = User::where('state', 0)->where('register_type',0)->count();
        $page = $this->my_page($request, $count);
        $user = User::where('state', 0)->where('register_type',0)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->with('recommend')->get();
        $data = [];
        foreach ($user as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['username'] = $v->username;
            $data[$k]['name'] = $v->name;
            $data[$k]['created_at'] = $v->created_at->format('Y-m-d H:i:s');
            $data[$k]['register_money'] = $v->register_money;
            $data[$k]['recommend'] = optional($v->recommend)->username;
        }
        return $this->json_data($data, $count);
    }

    //开通操作
    public function open_make(Request $request)
    {
        $user = User::where('id', $request->id)->where('state', 0)->first();
        if (empty($user)) {
            return $this->error('没有该用户');
        }
        
        $matching_day = Set::where('set_type', 'matching_day')->first()->details;
        $zyl_price = Set::where('set_type', 'zyl_price')->first()->details;
        $agio_interest = Set::where('set_type', 'agio_interest')->first()->details;
        //查询是否有接点用户
        
        $top_account = Account::where('user_id', $user->recommend_id)->first();
        if($user->recommend_id>0){
        
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
            if($user->recommend_id>0){
                $top_account->register=$top_account->register-$end_register;
                $top_account->agio=$top_account->agio-$end_agio;
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

    //删除未激活用户
    public function delete_no_open(Request $request){
        $user=User::where('id',$request->id)->where('state',0)->where('register_type',0)->first();
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

    public function user_delete(Request $request)
    {
    }
    //已开通会员页面
    public function open()
    {
        $user = User::where('state', 1)->paginate(10);
        return view('admin.user.open')->with('user', $user);
    }

    public function user_edit(Request $request){
        $user=User::where('id',$request->id)->first();
        if(empty($user)){
            return $this->error('没有该会员');
        }
        return view('admin.user.user_edit')->with('user',$user);
    }

    public function user_edit_make(Request $request){
        $user=User::where('id',$request->id)->first();
        if(empty($user)){
            return $this->error('没有该会员');
        }
        if($request->password){
            $this->validate($request, [
                'password' => 'min:6|max:25',
            ],[
                'password.min'=>'密码最少6位',
                'password.max'=>'密码最多25位',
            ]);

            $user->password=bcrypt($request->password);
        }

        if($request->sec_password){
            $this->validate(   
                $request,
                [
                    'sec_password'=>'min:6|max:25',
                ],
                [
                    'sec_password.min'=>'安全密码最少6位',
                    'sec_password.max'=>'安全密码最多25位',
                ]
            );
            $user->sec_password=bcrypt($request->sec_password);
        }

        $res=$user->save();
        if($res){
            return $this->success('成功');
        }else{
            return $this->error('失败');
        }
    }

    //获取已开通会员
    public function get_open(Request $request)
    {
        $user_where = [];
        if ($request->acc) {
            $user_where[] = ['username', '=', $request->acc];
        }
        if ($request->start) {
            $user_where[] = ['created_at', '>=', $request->start];
        }
        if ($request->end) {
            $end_time = date('Y-m-d', (strtotime($request->end) + 86400));
            $user_where[] = ['created_at', '<', $end_time];
        }

        $count = User::where('state', 1)->where($user_where)->count();
        $page = $this->my_page($request, $count);
        $user = User::where('state', 1)->where($user_where)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->with('matching')->with('account')->with('recommend')->get();
        $data = [];
        foreach ($user as $k => $v) {
            $data[$k]['id']=$v->id;
            $data[$k]['username'] = $v->username;
            $data[$k]['name'] = $v->name;
            $data[$k]['dynamic_type']=$v->dynamic_type;
            $data[$k]['recommend'] = optional($v->recommend)->username;
            $data[$k]['register'] = optional($v->account)->register;
            $data[$k]['lock'] = $v->matching->sum('zyl_num');
            $data[$k]['release'] = $v->matching->sum('release_money');
        }
        return $this->json_data($data, $count);
    }

    public function dynamic_make(Request $request){
        
        $user=User::where('id',$request->id)->first();
        if(empty($user)){
            return $this->error('没有该用户');
        }
        if($request->state==1){
            $state=1;
        }else if($request->state==2){
            $state=0;
        }else{
            return $this->error('传入状态错误');
        }
        $user->dynamic_type=$state;
        $res=$user->save();
        if($res){
            return $this->success('成功');
        }else{
            return $this->error('失败');
        }
    }

    //所有会员页面
    public function all_list()
    {
        return view('admin.user.all_list');
    }
    //获取所有会员
    public function get_all_list(Request $request)
    {
        $user_where = [];
        if ($request->acc) {
            $user_where[] = ['username', '=', $request->acc];
        }
        if ($request->start) {
            $user_where[] = ['created_at', '>=', $request->start];
        }
        if ($request->end) {
            $end_time = date('Y-m-d', (strtotime($request->end) + 86400));
            $user_where[] = ['created_at', '<', $end_time];
        }

        $count = User::where('state', '>', 0)->where($user_where)->count();
        $page = $this->my_page($request, $count);

        $user = User::where('state', '>', 0)->where($user_where)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->with('matching')->with('account')->with('recommend')->with('node_user')->get();

        $data = [];
        foreach ($user as $k => $v) {
            $data[$k]['username'] = $v->username;
            $data[$k]['name'] = $v->name;
            $data[$k]['recommend'] = optional($v->recommend)->username;
            $data[$k]['register'] = optional($v->account)->register;
            $data[$k]['lock'] = $v->matching->sum('money');
            $data[$k]['release'] = $v->matching->sum('release_money');
            $data[$k]['node_user'] = optional(optional($v->node_user)->top_username)->username;
            $data[$k]['node_place'] = (optional($v->node_user)->type == 1) ? 'A区' : 'B区';
            $data[$k]['created_at'] = $v->created_at->format('Y-m-d H:i:s');
        }
        return $this->json_data($data, $count);
    }

    public function frozen()
    {
        $user = User::where('state', 2)->paginate(10);
        return view('admin.user.frozen')->with('user', $user);
    }


    public function get_frozen(Request $request){
        $user_where = [];
        if ($request->acc) {
            $user_where[] = ['username', '=', $request->acc];
        }
        if ($request->start) {
            $user_where[] = ['created_at', '>=', $request->start];
        }
        if ($request->end) {
            $end_time = date('Y-m-d', (strtotime($request->end) + 86400));
            $user_where[] = ['created_at', '<', $end_time];
        }
        $count=User::where($user_where)->where('state',2)->count();  
        $page = $this->my_page($request, $count);
        $list=User::where($user_where)->where('state',2)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->get();
        $data=[];
        foreach($list as $k =>$v){
            $data[$k]['id']=$v->id;
            $data[$k]['username']=$v->username;
            $data[$k]['name']=$v->name;
            $data[$k]['created_at']=$v->created_at->toDateTimeString();
        }
        return $this->json_data($data, $count);
    }

    public function thaw(Request $request){
        $user=User::where('id',$request->id)->where('state',2)->first();
        if(empty($user)){
            return $this->error('没有该会员');
        }
        $user->state=1;
        $res=$user->save();
        if($res){
            return $this->success('解冻成功');
        }else{
            return $this->error('解冻失败');
        }
    }

    public function frozen_make(Request $request){
        $user=User::where('id',$request->id)->where('state',1)->first();
        if(empty($user)){
            return $this->error('没有该会员');
        }
        $user->state=2;
        $res=$user->save();
        if($res){
            return $this->success('封号成功');
        }else{
            return $this->error('封号失败');
        }
    }

    //配套页面
    public function matching_list()
    {
        return view('admin.user.matching_list');
    }
    //获取锁仓
    public function get_matching_list(Request $request)
    {
        $user_where = [];
        $matching_where = [];
        if ($request->acc) {
            $user_where[] = ['username', '=', $request->acc];
        }
        if ($request->start) {
            $matching_where[] = ['created_at', '>=', $request->start];
        }
        if ($request->end) {
            $end_time = date('Y-m-d', (strtotime($request->end) + 86400));
            $matching_where[] = ['created_at', '<', $end_time];
        }

        $count = Matching::count();
        $page = $this->my_page($request, $count);
        $matching = Matching::where($matching_where)->offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->whereHas('user', function ($query) use ($user_where) {
            $query->where($user_where);
        })->get();
        $data = [];
        foreach ($matching as $k => $v) {
            $data[$k]['username'] = $v->user->username;
            $data[$k]['name'] = $v->user->name;
            $data[$k]['money'] = $v->money;
            $data[$k]['release_money'] = empty($v->release_money) ? 0 : $v->release_money;
            $data[$k]['surplus_day'] = $v->lock_day - $v->created_at->diffInDays();
            $data[$k]['created_at'] = $v->created_at->format('Y-m-d H:i:s');
        }
        return $this->json_data($data, $count);
    }

    public function recommend_list()
    {
        return view('admin.user.recommend_list');
    }

    public function contact_list(Request $request)
    {
        if(empty($request->username)){
            $user = User::orderBy('id','asc')->first();
        }else{
            $user = User::where('username', $request->username)->first();
        }
        if (!$user) {
            return view('admin.user.contact_list')->with('type','1');
        }

        //首个用户查询业绩
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
        $nodes = Node::with('user')->whereIn('user_id', $uids ?: [])->where('level', 1)->get();

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

        return view('admin.user.contact_list', compact('result', 'user', 'username'));
    }

    public function tree(Request $request)
    {
        $username = $request->query('username', 'A00000000');
        $user = User::where('username', $username)->first();
        if (!$user) {
            return redirect('/admin/contact_list');
        }
        $uids = Node::where('top_id', $user->id)->where('level', '<', 4)->pluck('level', 'user_id');
        $uids->prepend(0, $user->id);
        $nodes = Node::with('user')->whereIn('user_id', $uids->keys())->where('level', 1)->get();
        $node = new \StdClass;
        $node->user_id = $user->id; 
        $node->top_id = 0;
        $node->type = 0;
        $node->user = $user;

        $nodes->prepend($node);
        $list = $this->formatTree1($nodes, $user, $uids);

        return view('admin.user._tw', compact('list', 'username'));


    }

    protected function nodeHtml($node)
    {
        return "<p><a href='/admin/tree?username={$node->user->username}'>{$node->user->username}</a></p><p>{$node->user->name}</p>";
    }

    protected function emptyHtml($p_username, $position)
    {
        return "<a href='/admin/register?" . "top_uid=$p_username&position=$position" . "'>注册</a>";
    }

    protected function formatTree1($nodes, $user, $uids)
    {
        $list = [];
        foreach ($nodes as $node) {
            $list[$node->top_id . '-' . $node->type] = $node;
        }

        $handled = [];
        $ret = [];

        foreach ($nodes as $node) {
            if (!isset($handled[$node->user_id])) {
                $ret[] = [
                    [
                        "v" => "{$node->user_id}",
                        "f" => $this->nodeHtml($node),
                    ],
                    $node->top_id ? "{$node->top_id}" : '',
                    "",
                ];
                $handled[$node->user_id] = true;
            }

            $level = $uids[$node->user_id];
            if ($level < 3) {
                //左子
                if (isset($list[$node->user_id . '-1'])) {
                    $lnode = $list[$node->user_id . '-1'];
                    $ret[] = [
                        [
                            "v" => "{$lnode->user_id}",
                            "f" => $this->nodeHtml($lnode),
                        ],
                        "{$lnode->top_id}",
                        "",
                    ];
                    $handled[$lnode->user_id] = true;

                } else {
                    $ret[] = [
                        [
                            "v" => $node->user_id . '-1',
                            "f" => $this->emptyHtml($node->user->username, 1),
                        ],
                        "{$node->user_id}",
                        "",
                    ];
                    $handled[$node->user_id . '-1'] = true;
                }

                //右子
                if (isset($list[$node->user_id . '-2'])) {
                    $rnode = $list[$node->user_id . '-2'];
                    $ret[] = [
                        [
                            "v" => "{$rnode->user_id}",
                            "f" => $this->nodeHtml($rnode),
                        ],
                        "{$rnode->top_id}",
                        "",
                    ];
                    $handled[$rnode->user_id] = true;

                } else {
                    $ret[] = [
                        [
                            "v" => $node->user_id . '-2',
                            "f" => $this->emptyHtml($node->user->username, 2),
                        ],
                        "{$node->user_id}",
                        "",
                    ];
                    $handled[$node->user_id . '-2'] = true;
                }
            }
        }

        return $ret;
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

    public function loginUser(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return $this->error('错误用户');
        }

        $request->session()->put('uid', $user->id);

        return $this->success();
    }

    public function gettjtree(Request $request)
    {
        $username = $request->id;
        $user = User::where('username', $username)->first();
        if (!$user) {
            return [];
        }
        $users = User::with('account')->where('recommend_id', $user->id)->get();
        $list = [];
        foreach ($users as $user) {
            $_tmp = [];
            $_tmp['isParent'] = User::where('recommend_id', $user->id)->count() > 0;
            $_tmp['name'] = sprintf('[%s]%s][%s美金]', $user->username, $user->name, $user->account->register);
            $_tmp['pid'] = $username;
            $_tmp['id'] = $user->username;
            $list[] = $_tmp;
        }

        return $list;
    }
}

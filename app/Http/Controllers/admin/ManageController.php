<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\AdminUser;
use App\Models\AdminAuth;
use App\Models\Set;
use Illuminate\Support\Facades\Hash;
class ManageController extends Controller
{
    //授权账号管理
    public function manage_user()
    {
        $auth=AdminAuth::where('p_id', '>', 0)->get();
        return view('admin.manage.manage_user')->with('auth', $auth);
    }

    public function get_manage_user(Request $request){
        $count=AdminUser::count();
        $page = $this->my_page($request, $count);
        $admin_user=AdminUser::offset($page['page'])->limit($page['limit'])->orderBy('id', 'desc')->get();
        $data=[];
        foreach($admin_user as $k=>$v){
            $data[$k]['id']=$v->id;
            $data[$k]['username']=$v->username;
        }

        return $this->json_data($data,$count);
    }

    //管理员密码修改
    public function password()
    {
        return view('admin.manage.password');
    }

    public function password_make(Request $request){
        $this->validate(
            $request,
            [
                'password'=>'required|min:6|max:25',
                'new_password'=>'required|confirmed|min:6|max:25'
            ],
            [
                'password.required'=>'请输入旧密码',
                'password.required'=>'旧密码密码最低为6位',
                'password.required'=>'旧密码密码最高为25位',
                'new_password.required'=>'请输入新密码',
                'new_password.confirmed'=>'两次新密码不一致',
                'new_password.min'=>'管理员密码最低为6位',
                'new_password.max'=>'密码过长',
            ]
        );

        $admin_id=$request->session()->get('admin_id');
        $admin_user=AdminUser::where('id',$admin_id)->first();
        if(!Hash::check($request->password,$admin_user->password)){
            return $this->error('原密码错误');
        }
        $new_password=bcrypt($request->new_password);
        $admin_user->password=$new_password;
        $res=$admin_user->save();
        if($res){
            return $this->success('修改成功');
        }else{
            return $this->error('修改失败');
        }
    }

    //系统开关设置
    public function on_set()
    {
        $on_set=Set::where('set_type','on_set')->first()->details;
        $on_set=json_decode($on_set,1);

        return view('admin.manage.on_set')->with('on_set',$on_set);
    }

    public function on_set_make(Request $request){
        $set=Set::where('set_type','on_set')->first();
        if($request->set=='on'){
            $state='on';
        }else{
            $state='off';
        }
        $data=['state'=>$state,'content'=>$request->content];

        /* $set->set_type='on_set';
        $set->set_explain='系统开关和关闭提示'; */
        $set->details=json_encode($data);
        $res=$set->save();
        if($res){
            return $this->success('修改成功');
        }else{
            return $this->error('修改失败');
        }
    }

    //系统安全设置
    public function security_set()
    {
        return view('admin.manage.password');
    }

    //奖金参数设置
    public function bonus_set()
    {
        $set=Set::get();
        foreach($set as $k => $v){
            if($v->set_type=='zyl_price'){
                $data['zyl_price']=$v->details;
            }
            if($v->set_type=='matching_day'){
                $data['matching_day']=$v->details;
            }
            if($v->set_type=='dynamic_profit_inserest'){
                $data['dynamic_profit_inserest']=$v->details;
            }
            if($v->set_type=='dynamic_profit_restrict'){
                $data['dynamic_profit_restrict']=$v->details;
            }
            if($v->set_type=='static_profit'){
                $data['static_profit']=json_decode($v->details,1);
            }
            if($v->set_type=='recharge_address'){
                $data['recharge_address']=json_decode($v->details,1);
            }
            if($v->set_type=='extracts_num'){
                $data['extracts_num']=json_decode($v->details,1);
            }
            if($v->set_type=='extracts_interest'){
                $data['extracts_interest']=json_decode($v->details,1);
            }
            if($v->set_type=='agio_interest'){
                $data['agio_interest']=$v->details;
            }
            if($v->set_type=='money_change'){
                $data['money_change']=json_decode($v->details,1);
            }
            if($v->set_type=='release_interest'){
                $data['release_interest']=$v->details;
            }
            if($v->set_type=='profit_change'){
                $data['profit_change']=$v->details;
            }
        }
        return view('admin.manage.bonus_set')->with('data',$data);
    }
    //奖金参数设置修改
    public function bonus_set_make(Request $request){
        if($request->zyl_price){
            $res=Set::where('set_type','zyl_price')->update(['details'=>$request->zyl_price]);
        }
        if($request->matching_day){
            $res=Set::where('set_type','matching_day')->update(['details'=>$request->matching_day]);
        }
        if($request->dynamic_profit_inserest){
            $res=Set::where('set_type','dynamic_profit_inserest')->update(['details'=>$request->dynamic_profit_inserest]);
        }
        if($request->dynamic_profit_restrict){
            $res=Set::where('set_type','dynamic_profit_restrict')->update(['details'=>$request->dynamic_profit_restrict]);
        }
        if($request->static_profit){
            $res=Set::where('set_type','static_profit')->update(['details'=>json_encode($request->static_profit)]);
        }
        if($request->recharge_address){
            $res=Set::where('set_type','recharge_address')->update(['details'=>json_encode($request->recharge_address)]);
        }
        if($request->extracts_num){
            $res=Set::where('set_type','extracts_num')->update(['details'=>json_encode($request->extracts_num)]);
        }
        if($request->extracts_interest){
            $res=Set::where('set_type','extracts_interest')->update(['details'=>json_encode($request->extracts_interest)]);
        }
        if($request->agio_interest){
            $res=Set::where('set_type','agio_interest')->update(['details'=>$request->agio_interest]);
        }
        if($request->release_interest){
            $res=Set::where('set_type','release_interest')->update(['details'=>$request->release_interest]);
        }

        $money_change_init=['zyl_register','register_agio','consume_agio'];
        foreach($money_change_init as $v){
            $money_change[$v]=empty($request->money_change[$v])?'':$request->money_change[$v];
        }
        Set::where('set_type','money_change')->update(['details'=>json_encode($money_change)]);

        if($request->profit_change){
            $profit_change='on';
        }else{
            $profit_change='off';
        }
        Set::where('set_type','profit_change')->update(['details'=>$profit_change]);
        return $this->success('修改成功');
    }


    //股数交易流设置
    public function deal_set()
    {
        return view('admin.manage.password');
    }


    public function manage_add_view(){
        return view('admin.manage.manage_add_view');
    }


    
    //添加管理员
    public function manage_add(Request $request)
    {
        $this->validate(
            $request,
            [
                'username'=>'required|unique:admin_users|min:5|max:25',
                'password'=>'required|min:6|max:25',
            ],
            [
                'username.required'=>'请输入管理员账号',
                'username.unique'=>'该管理员账号已存在',
                'username.min'=>'管理员账号最低为5位',
                'username.max'=>'管理员账号最高为25位',
                'password.required'=>'请输入管理员密码',
                'password.required'=>'管理员密码最低为6位',
                'password.required'=>'管理员密码最高为25位',
            ]
        );
        $password=bcrypt($request->password);
        $admin_user=new AdminUser();
        $admin_user->username=$request->username;
        $admin_user->password=$password;
        $res=$admin_user->save();
        if($res){
            return $this->success('添加成功');
        }else{
            return $this->error('添加失败');
        }
    }

    public function manage_update(Request $request)
    {
    }

    public function manage_delete(Request $request)
    {
        $admin_user=AdminUser::where('id',$request->id)->first();
        if(empty($admin_user)){
            return $this->error('没有该管理员');
        }
        if($admin_user->username=='admin'){
            return $this->error('admin管理员无法删除');
        }
        $res=$admin_user->delete();
        if($res){
            return $this->success('删除成功');
        }else{
            return $this->error('删除失败');
        }
    }


}

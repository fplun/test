<?php

namespace App\Http\Controllers\User;

use App\Mail\ForgotPassword;
use App\Models\User;
use App\Models\Node;
use App\Models\News;
use App\Models\Account;
use App\Models\Matching;
use App\Models\Set;
use App\Models\Profit;
use Hash;
use Illuminate\Http\Request;
use Rzy\Emailcode\EmailTrait;
use Rzy\Smscode\SmsTrait;
use Validator;
use App;

class AccountController extends Controller
{
    use EmailTrait, SmsTrait;

    public function __construct()
    {
        $this->middleware('userLogin')->except('login', 'forgotPassword', 'toemailpwd', 'tophonepwd', 'sendcode', 'sendEmailCode', 'resetPassword');
    }

    public function index(Request $request)
    {
        $date=date('Y-m-d',time());
        $locale = App::getLocale();
        $user = User::with('account')->find($request->user->id);
        $news = News::orderBy('id', 'desc')->limit(5)->get();
        $direct_count = Node::where('top_id', $user->id)->where('level', 1)->count();
        $recommend_count = Node::where('top_id', $user->id)->count();

        $matching_money=Matching::where('user_id',$request->user->id)->where('state',0)->sum('money');
        $matching_zyl_num=Matching::where('user_id',$request->user->id)->where('state',0)->sum('zyl_num');
        $matching_release_money=Matching::where('user_id',$request->user->id)->where('state',0)->sum('release_money');

        $profit['ji']=Profit::where('type',0)->where('user_id',$request->user->id)->where('state',0)->whereDate('created_at','>=',$date)->sum('money');
        $profit['dong']=Profit::where('type',1)->where('user_id',$request->user->id)->where('state',0)->whereDate('created_at','>=',$date)->sum('money');
        $profit['all_profit']=Profit::where('type','<=',1)->where('user_id',$request->user->id)->whereDate('created_at','>=',$date)->sum('money');

        $set['zyl_price']=Set::where('set_type','zyl_price')->first()->details;

        $account=Account::where('user_id',$request->user->id)->first();
        return view('user.index', ['locale' => $locale, 'user' => $request->user,'account'=>$account, 'news' => $news, 'direct_count' => $direct_count, 'recommend_count' => $recommend_count,'matching_money'=>$matching_money,'matching_zyl_num'=>$matching_zyl_num,'matching_release_money'=>$matching_release_money,'profit'=>$profit,'set'=>$set]);
    }

    public function login()
    {
        $request = request();

        if (request()->isMethod('get')) {
            return view('user.login');
        }
        $on_set=Set::where('set_type','on_set')->first()->details;
        $on_set=json_decode($on_set,1);
        if($on_set['state']!='on'){
            return $this->error(__($on_set['content']));
        }
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', $request->input('username'))->first();
        if (!$user) {
            return $this->error(__('账号名或密码或验证码有误'));
        }
        if (!Hash::check($request->input('password'), $user->password)) {
            return $this->error(__('账号名或密码或验证码有误'));
        }
        if($user->state==0){
            return $this->error(__('您的账号还未激活，请先去激活'));
        }
        if($user->state==2){
            return $this->error(__('您的账号已被封停'));
        }
        session(['uid' => $user->id]);

        return $this->success(__('登录成功'));
    }

    public function logout()
    {
        request()->session()->forget('uid');
        return redirect('/login');
    }

    public function forgotPassword()
    {
        return view('user.forgotPassword');
    }

    public function toemailpwd(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.toemailpwd');
        }
        $this->validate($request, [
            'huiNumber' => 'required',
            'huiPhone' => 'required',
            'code' => 'required',
        ]);

        if (!$this->checkEmailCode($request->huiPhone, $request->code)) {
            return $this->error('验证码错误');
        }
        $user = User::where('username', $request->huiNumber)->first();
        $request->session()->flash('resetPwdUser', $user);

        return $this->success('验证成功');

    }

    public function tophonepwd(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.tophonepwd');
        }
        $this->validate($request, [
            'huiNumber' => 'required',
            'huiPhone' => 'required',
            'code' => 'required',
        ]);

        if (!$this->checkSmsCode($request->huiPhone, $request->code)) {
            return back()->withErrors(['验证码错误']);
        }
        $user = User::where('username', $request->huiNumber)->first();
        $request->session()->flash('resetPwdUser', $user);

        return redirect('/resetPassword');

    }

    public function resetPassword(Request $request)
    {
        if ($request->isMethod('get')) {
            $user = session('resetPwdUser');
            if (!$user) {
                return back();
            }
            return view('user.resetPassword')->with('user', $user);
        }

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'confirmed',
        ]);
        if ($validator->fails()) {
            return $this->error($validator->first());
        }

        $user = User::where('username', $request->username)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->success('修改成功');

    }

    public function resetLoginPwd(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.account.resetLoginPwd');
        }
        $this->validate($request, [
            'sec_password' => 'required',
            'password' => 'confirmed',
        ]);
        $user = $request->user;
        if (!Hash::check($request->sec_password, $user->sec_password)) {
            return back()->withErrors(['安全密码错误']);
        }
        $user->password = bcrypt($request->password);
        $user->save();

        return back()->with('message', '修改成功');
    }

    public function resetSafePwd(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.account.resetSafePwd');
        }
        $this->validate($request, [
            'sec_password' => 'required',
            'password' => 'confirmed',
        ]);
        $user = $request->user;
        if (!Hash::check($request->sec_password, $user->sec_password)) {
            return back()->withErrors(['安全密码错误']);
        }
        $user->sec_password = bcrypt($request->password);
        $user->save();

        return back()->with('message', '修改成功');
    }

    public function forgotSafePwd()
    {
        return view('user.account.forgotSafePwd');
    }

    public function toEmailSafe(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.account.toEmailSafe');
        }

        $this->validate($request, [
            'huiPhone' => 'required',
            'code' => 'required',
        ]);

        if (!$this->checkEmailCode($request->huiPhone, $request->code)) {
            return back()->withErrors(['验证码错误']);
        }

        return redirect('/setSafePwd');

    }

    public function toPhoneSafe(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.account.toPhoneSafe');
        }

        $this->validate($request, [
            'huiPhone' => 'required',
            'code' => 'required',
        ]);

        if (!$this->checkSmsCode($request->huiPhone, $request->code)) {
            return back()->withErrors(['验证码错误']);
        }

        return redirect('/setSafePwd');

    }

    public function setSafePwd(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('user.account.setSafePwd');
        }
        $this->validate($request, [
            'password' => 'required|confirmed|min:6|max:25',
        ]);
        $user = $request->user;
        $user->sec_password = bcrypt($request->password);
        $user->save();

        return back()->with('message', '修改成功');

    }

    public function useredit(Request $request)
    {
        $user = User::with('account')->find($request->user->id);
        if ($request->isMethod('get')) {
            $matching=Matching::where('user_id',$request->user->id)->where('state',0)->sum('money');
            $static_profit=Set::where('set_type','static_profit')->first()->details;
            $static_profit=json_decode($static_profit,1);
            $matching_init=0;
            foreach($static_profit as $v){
                if($matching>=$v['money']){
                    $matching_init=$v['money'];
                }else{
                    break;
                }
            }

            return view('user.account.useredit', ['user' => $user])->with('matching_init',$matching_init);
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        if (!$account = $user->account) {
            $account = new Account;
            $account->user_id = $user->id;
        }
        $account->extract_type = $request->extract_type;
        $account->extract_address = $request->extract_address;
        $account->save();
        return back()->with('message', '修改成功');
    }

    public function sendEmailsafe(Request $request)
    {
        $emailReg = "/[a-zA-Z0-9]{1,10}@[a-zA-Z0-9]{1,5}\.[a-zA-Z0-9]{1,5}/";
        if (!preg_match($emailReg, $request->email)) {
            return $this->error('邮箱格式错误');
        }
        if ($request->email !== $request->user->email) {
            return $this->error('请输入注册时邮箱');
        }
        $this->sendCodeAndSave($request->email);

        return $this->success('发送成功');
    }

    public function sendcodesafe(Request $request)
    {
        if ($request->phone !== $request->user->phone) {
            return $this->error('请输入注册手机号');
        }
        $this->sendSmsAndSave($request->phone);

        return $this->success('发送成功');
    }

    public function sendcode(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return $this->error('没有此用户');
        }
        if ($user->phone !== $request->phone) {
            return $this->error('手机号与注册手机号不一致');
        }

        $this->sendSmsAndSave($request->phone);
        return $this->success('发送成功');
    }

    public function sendEmailCode(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return $this->error('没有此用户');
        }
        if ($user->email !== $request->email) {
            // return $this->error('邮箱与注册邮箱不一致');
        }
        // dd($request->email);
        $this->sendCodeAndSave($request->email);
        return $this->success('发送成功');
    }
}

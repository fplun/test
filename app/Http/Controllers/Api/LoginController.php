<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Rzy\Emailcode\EmailTrait;
use App\Models\EUser;
use App\Models\User;
use App\Models\ELogin;
use Illuminate\Support\Facades\Hash;

/**
 * @title 登录
 * @description 接口说明
 */
class LoginController extends Controller
{
    use EmailTrait;
    /**
     * @title 登录
     * @description 登录接口
     * @author 开发者
     * @url /api/login
     * @method POST
     * @param name:username type:string require:1 other:请输入用户名或者邮箱 desc:用户名或者邮箱
     * @param name:password type:string require:1 other: desc:密码
     *
     * @return id:id
     * @return token:token验证
     */
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
            'username'=>'required',
            'password'=>'required',
        ],
            [
            'username.required'=>'请输入用户名或者邮箱',
            'password.required'=>'请输入密码',
        ]
        );
        $emailReg = "/[a-zA-Z0-9]{1,10}@[a-zA-Z0-9]{1,5}\.[a-zA-Z0-9]{1,5}/";
        //邮箱
        if (preg_match($emailReg, $request->username)) {
            $user=EUser::where('email',$request->username)->first();
            $user_type='0';
            if(empty($user)){
                //查询众易链表是否有  该用户   提出警告
                $email_type=User::where('email',$request->username)->first();
                if(!empty($email_type)){
                    return $this->error('众易链用户请使用用户名登录');
                }
            }
        //用户名
        } else {
            $user=User::where('username',$request->username)->first();
            if(empty($user)){
                return $this->error('没有该用户');
            }
            if($user->state==0){
                return $this->error('账号未激活,无法登录');
            }
            if($user->state==2){
                return $this->error('账号被封停,无法登录');
            }
            $user_type='1';
        }

        if(empty($user)){
            return $this->error('没有该用户');
        }

        if(!Hash::check($request->password,$user->password)){
            return $this->error('密码错误');
        }

        $e_login=ELogin::where('user_id',$user->id)->where('type',$user_type)->first();
        if(empty($e_login)){
            $e_login=new ELogin;
            $e_login->user_id=$user->id;
            $e_login->type=$user_type;
        }

        $e_login->token=md5(uniqid(md5(microtime(true).$e_login->id.'EEECM'),true));
        $e_login->expire_at=date('Y-m-d H:i:s',strtotime('+1 day'));
        $res=$e_login->save();
        if($res){
            $data=['token'=>$e_login->token,'id'=>$e_login->id];
            return $this->success('登录成功',$data);
        }else{
            return $this->error('登录失败');
        }
    }
    /**
     * @title 注册
     * @description 注册接口
     * @author 开发者
     * @url /api/register
     * @method POST
     * @param name:email type:string require:1 other: desc:邮箱
     * @param name:password type:string require:1 other:min:6,max:25 desc:密码
     * @param name:password_confirmation type:string require:1 other: desc:重复密码
     * @param name:email_code type:string require:1 other:先用注册发送邮件获取 desc:邮箱验证码
     *
     */
    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
            'email'=>'required|email|unique:users,email|unique:e_users,email',
            'password' => 'required|confirmed|min:6|max:25',
            'email_code'=>'required'
        ],
            [
            'email.required'=>'请输入邮箱',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'该邮箱已被使用',
            'password.required'=>'请输入密码',
            'password.confirmed'=>'两次验证码输入不一致',
            'password.min'=>'密码最少6位',
            'password.max'=>'密码最多25位',
            'email_code.required'=>'请输入邮箱验证码',
        ]
        );

        $email_check=$this->e_email_check($request->email, $request->email_code);
        if (!$email_check['success']) {
            return $this->error('邮箱验证码错误');
        }
        $e_user=new EUser;
        $e_user->email=$request->email;
        $e_user->password=bcrypt($request->password);
        $res=$e_user->save();
        if ($res) {
            return $this->success('注册成功');
        } else {
            return $this->error('注册失败');
        }
    }
    /**
     * @title 注册发送邮件
     * @description 注册发送邮件接口
     * @author 开发者
     * @url /api/send_email
     * @method POST
     * @param name:email type:string require:1 other: desc:邮箱
     *
     */
    public function send_email(Request $request)
    {
        $this->validate(
            $request,
            [
            'email'=>'required|email|unique:users,email|unique:e_users,email',
        ],
            [
            'email.required'=>'请输入邮箱',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'该邮箱已被使用',
        ]
        );

        $send_res=$this->e_send_email($request->email);
        if ($send_res['success']) {
            return $this->success($send_res['message']);
        } else {
            return $this->error($send_res['message']);
        }
    }
}

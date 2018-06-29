<?php

namespace Rzy\Emailcode;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Rzy\Emailcode\Mail\ForgotPassword;
use Rzy\Emailcode\Models\EmailCode;

trait EmailTrait
{
    public function sendEmail($email, $msg, $subject = 'ATEC 找回密码')
    {
        $mail = (new ForgotPassword($msg))->subject($subject);
        Mail::to($email)->send($mail);

        return [
            'result' => 0,
            'description' => '发送成功',
        ];
    }

    protected function checkEmailCode($email, $code, $expire = 60 * 5)
    {
        $email_code = EmailCode::where('email', $email)->where('code', $code)->where('status', EmailCode::STATUS_UNUSED)->orderBy('id', 'desc')->first();
        if (!$email_code || time() - $email_code->created_at->timestamp > $expire) {
            return ['message' => '验证码错误'];
        }
        $email_code->status = EmailCode::STATUS_USED;
        $email_code->save();

        return true;
    }
    //电子钱包邮箱检测
    protected function e_email_check($email, $code, $expire = 60 * 5)
    {
        $email_code = EmailCode::where('email', $email)->where('code', $code)->where('type',1)->where('status', EmailCode::STATUS_UNUSED)->orderBy('id', 'desc')->first();
        if (!$email_code || time() - $email_code->created_at->timestamp > $expire) {
            return ['success'=> false,'message' => '验证码错误'];
        }
        $email_code->status = EmailCode::STATUS_USED;
        $email_code->save();

        return ['success'=> true,'message' => '验证码正确'];
    }
    

    protected function sendCodeAndSave($email)
    {
        $emailReg = "/[a-zA-Z0-9]{1,10}@[a-zA-Z0-9]{1,5}\.[a-zA-Z0-9]{1,5}/";

        if (!preg_match($emailReg, $email)) {
            return [
                'success' => false,
                'message' => '请输入正确的邮箱',
            ];
        }
        $dayCount = EmailCode::whereDate('created_at', date("Y-m-d"))->where('ip', request()->ip())->count();
        if ($dayCount > 20) {
            return [
                'success' => false,
                'message' => '发送验证码次数超过限制',
            ];
        }
        $emailCount = EmailCode::where('email', request('email'))->where('created_at', '>', Carbon::now()->subHours(1))->count();
        if ($emailCount > 12) {
            return [
                'success' => false,
                'message' => '发送验证码次数超过限制',
            ];
        }
        $code = mt_rand(1000, 9999);
        // $content = '你的验证码为' . $code . ', 有效时间为5分钟';
        $email_code = new EmailCode;
        $email_code->ip = request()->ip();
        $email_code->email = $email;
        $email_code->code = $code;
        $email_code->result = '';
        $email_code->save();
        $result = $this->sendEmail($email, $code);
        $email_code->result = $result['description'];
        $email_code->save();
        if ($result['result'] == 0) {
            return [
                'success' => true, 
                'message' => '发送成功',
            ];
        }

        return [
            'success' => false,
            'message' => '发送失败, 请重试',
        ];
    }
    //电子钱包发送验证码
    protected function e_send_email($email)
    {
        $emailReg = "/[a-zA-Z0-9]{1,10}@[a-zA-Z0-9]{1,5}\.[a-zA-Z0-9]{1,5}/";

        if (!preg_match($emailReg, $email)) {
            return [
                'success' => false,
                'message' => '请输入正确的邮箱',
            ];
        }
        $dayCount = EmailCode::whereDate('created_at', date("Y-m-d"))->where('type',1)->where('ip', request()->ip())->count();
        if ($dayCount > 20) {
            return [
                'success' => false,
                'message' => '发送验证码次数超过限制',
            ];
        }
        $emailCount = EmailCode::where('email', request('email'))->where('type',1)->where('created_at', '>', Carbon::now()->subHours(1))->count();
        if ($emailCount > 12) {
            return [
                'success' => false,
                'message' => '发送验证码次数超过限制',
            ];
        }
        $code = mt_rand(1000, 9999);
        // $content = '你的验证码为' . $code . ', 有效时间为5分钟';
        $email_code = new EmailCode;
        $email_code->ip = request()->ip();
        $email_code->email = $email;
        $email_code->code = $code;
        $email_code->result = '';
        $email_code->type=1;
        $email_code->save();
        $result = $this->sendEmail($email, $code ,'ATEC 电子钱包');
        $email_code->result = $result['description'];
        $email_code->save();
        if ($result['result'] == 0) {
            return [
                'success' => true, 
                'message' => '发送成功',
            ];
        }

        return [
            'success' => false,
            'message' => '发送失败, 请重试',
        ];
    }
}

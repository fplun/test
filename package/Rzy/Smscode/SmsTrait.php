<?php

namespace Rzy\Smscode;

use Carbon\Carbon;
use Rzy\Smscode\Models\SmsCode;

trait SmsTrait
{
    public function sendSms($phones, $content)
    {
        $username = urlencode(config('sms.sms_username'));
        $password = urlencode(config('sms.sms_password'));
        $sign = config('sms.sms_sign');

        $sign = str_start($sign, '【');
        $sign = str_finish($sign, '】');

        if (!str_contains($content, $sign)) {
            $content .= $sign;
        }
        $content = urlencode(iconv("UTF-8", "gb2312//IGNORE", trim($content)));
        $url = "http://api.1086sms.com/api/send.aspx?username=$username&password=$password&mobiles=$phones&content=$content";

        $ret = file_get_contents($url);
        $ret = urldecode($ret);
        $result = [];
        foreach (explode('&', $ret) as $v) {
            list($key, $value) = explode('=', $v);
            $result[$key] = iconv('gb2312', 'utf-8', $value);
        }
        return $result;
    }

    protected function checkSmsCode($phone, $code, $expire = 60 * 5)
    {
        $sms_code = SmsCode::where('phone', $phone)->where('code', $code)->where('status', SmsCode::STATUS_UNUSED)->orderBy('id', 'desc')->first();
        if (!$sms_code || time() - $sms_code->created_at->timestamp > $expire) {
            return ['message' => '验证码错误'];
        }
        $sms_code->status = SmsCode::STATUS_USED;
        $sms_code->save();

        return true;
    }

    protected function sendSmsAndSave($phone)
    {
        if (!preg_match('~^1[0-9]{10}$~', $phone)) {
            return [
                'success' => false,
                'message' => '请输入正确的手机号码',
            ];
        }
        $dayCount = SmsCode::whereDate('created_at', date("Y-m-d"))->where('ip', request()->ip())->count();
        if ($dayCount > 20) {
            return [
                'success' => false,
                'message' => '发送短信次数超过限制',
            ];
        }
        $phoneCount = SmsCode::where('phone', request('phone'))->where('created_at', '>', Carbon::now()->subHours(1))->count();
        if ($phoneCount > 12) {
            return [
                'success' => false,
                'message' => '发送短信次数超过限制',
            ];
        }
        $code = mt_rand(1000, 9999);
        $content = '你的验证码为' . $code . ', 有效时间为5分钟';
        $sms_code = new SmsCode;
        $sms_code->ip = request()->ip();
        $sms_code->phone = $phone;
        $sms_code->code = $code;
        $sms_code->result = '';
        $sms_code->save();
        $result = $this->sendSms($phone, $content);
        $sms_code->result = $result['description'];
        $sms_code->save();
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

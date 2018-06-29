<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Rzy\Emailcode\EmailTrait;

class TestController extends Controller
{
    use EmailTrait;

    public function __construct()
    {

    }

    public function sms()
    {
        $phone = '15639279238';
        return $this->sendCodeAndSave($phone);
    }

    public function email()
    {
        return $this->sendCodeAndSave('ruziyi@qq.com');
    }

    public function locale()
    {
        return __('menu.index');

    }

    public function test()
    {
        $user = User::with('recommend')->get();
        return ($user);
    }
}

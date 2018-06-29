<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegister extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|min:6|max:25|unique:users',
            'password' => 'required|min:6|max:25',
            'sec_password' => 'required|min:6|max:25',
            'name' => 'required|max:25',
            'phone' => ['required','unique:users','regex:/^((13[0-9])|(15[^4])|(166)|(17[0-8])|(18[0-9])|(19[8-9])|(147)|(145))\\d{8}$/'],
            'email' => 'required|unique:users|email',
            'extract_type'=>'required',
            'extract_address'=>'required',
            'recommend'=>'required|exists:users,username',
            'contact'=>'required|exists:users,username',
            'position'=>'required|digits_between:1,2',
            'money'=>'required|min:100|integer',
        ];
    }

    public function messages()
    {
        return [
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

            'phone.required' => '请输入手机号',
            'phone.unique' => '该手机号已被占用',
            'phone.regex' => '手机号格式错误',

            'email.required' => '请输入邮箱',
            'email.unique' => '该邮箱已被占用',
            'email.email' => '邮箱格式错误',

            'extract_type.required' => '请输入提币类型',
            'extract_address.required' => '请输入提币地址',

            'recommend.required' => '请输入推荐人编号',
            'recommend.exists' => '推荐人不存在',
            'contact.required' => '请输入接点人编号',
            'contact.exists'=>'接点人不存在',
            'position.required' => '请输入接点位置',
            'position.digits_between' => '接点位置格式错误',

            'money.required' => '请输入投资金额',
            'money.min' => '投资金额最低为100',
            'money.integer' => '投资金额格式错误',
        ];
    }
}

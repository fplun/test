<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminAuth;

class AuthController extends Controller
{
    //
    public function list()
    {
        $auth=AdminAuth::get();
        return view('admin.auth.list')->with('auth', $auth);
    }

    public function auth_add(Request $request)
    {
        $this->validate(
            $request,
            [
                'title'=>'required|unique:admin_auths|max:50',
                'uri'=>'max:50',
            ],
            [
                'title.required'=>'请输入权限名称',
                'title.unique'=>'权限名称重复',
                'title.max'=>'权限名称过长',
                'uri.max'=>'路径过长',
            ]
        );

        $p_id=empty($request->p_id)?0:$request->p_id;
        $auth_order=AdminAuth::where('p_id', $p_id)->orderBy('order', 'desc')->select('order')->first();
        $order=empty($auth_order->order)?0:$auth_order->order;

        $auth=new AdminAuth;
        $auth->p_id=$p_id;
        $auth->order=$order+1;
        $auth->title=$request->title;
        $auth->uri=$request->uri;
        $res=$auth->save();
        
        if ($res) {
        } else {
        }
        return redirect('/admin/auth_list');
    }

    public function auth_update()
    {
    }

    public function auth_delete()
    {
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ELogin;

class ApiCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(empty($request->header('token')) || empty($request->header('id'))){
            return response()->json([
                'message' => '请登录',
                'status' => '1001',
                'data'=>[],
            ]);
        }
        $e_login=ELogin::where('token',$request->header('token'))->where('id',$request->header('id'))->first();
        if(empty($e_login)){
            return response()->json([
                'message' => '请登录',
                'status' => '1002',
                'data'=>[],
            ]);
        }
        if(time()>strtotime($e_login->expire_at)){
            return response()->json([
                'message' => '请登录',
                'status' => '1003',
                'data'=>[],
            ]);
        };
        $request->e_login=$e_login;
        return $next($request);
    }
}

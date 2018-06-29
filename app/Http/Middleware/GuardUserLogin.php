<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class GuardUserLogin
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
        $uid = session('uid');
        if (!$uid) {
            return redirect('/login');
        }
        $user = User::find($uid);
        if (!$user) {
            return redirect('/login');
        }
        $request->user = $user;
        return $next($request);
    }
}

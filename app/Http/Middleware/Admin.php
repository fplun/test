<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        $admin_id = $request->session()->get('admin_id');
        if (!$admin_id) {
            return redirect('/admin');
        }
        return $next($request);
    }
}

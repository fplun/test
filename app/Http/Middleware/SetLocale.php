<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Cookie;

class SetLocale
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
        $locale = $request->query('_locale');
        if ($locale) {
            Cookie::queue('locale', $locale);
            App::setLocale($locale);
            return $next($request);

        }
        if ($locale = $request->cookie('locale')) {
            App::setLocale($locale);
            return $next($request);
        }

        return $next($request);
    }
}

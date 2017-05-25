<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class ChkUserNotLoggedin
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
        if(Auth::guard('web')->check() == true)
        {
            abort(401, 'unauthorized access forbidden');
        }
        return $next($request);
    }
}

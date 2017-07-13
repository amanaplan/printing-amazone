<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class ChkSuperAdmin
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
        if(Auth::guard('admin')->check() == false || Auth::user()->super_admin == 0)
        {
            abort(401, 'unauthorized access forbidden');
        }
        return $next($request);
    }
}

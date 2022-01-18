<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class police_department
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'department')
    {
 
        if(Auth::check()){

            return $next($request);
        }
        if (!Auth::guard($guard)->check()) {

            return redirect()->route('department.login');
        }


        return $next($request);
    }
}

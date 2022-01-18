<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
//    public function handle($request, Closure $next, $guard = null)
//    {
//
//        $access_token = \Request::header('Authorization');
//
//
//        if (Auth::guard($guard)->check()) {
//            return redirect('/home');
//        }
//
//        return $next($request);
//
//
//    }
    public function handle($request, Closure $next, $guard = null)
    {
        
        // switch ($guard) {
        //     case 'department' :
        //         if (Auth::guard($guard)->check()) {
        //             return redirect()->route('department.home');
        //         }
        //         break;
        //     case 'fire' :
        //         if (Auth::guard($guard)->check()) {
        //             return redirect()->route('fire.home');
        //         }
        //         break;
        //     default:
        //         if (Auth::guard($guard)->check()) {
        //             return redirect()->route('home');
        //         }
        //         break;
        // }
        // return $next($request);

        if (Auth::guard($guard)->check()) {
            return redirect()->route('home');
        }
       
        return $next($request);
    }
}

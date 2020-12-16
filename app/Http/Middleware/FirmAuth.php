<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class FirmAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, $guard='firm')
     {
         if(Auth::guard($guard)->check())
         {
             return $next($request);
         }
         return redirect()->guest('/');
     }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Lang;

class Language
{
    public function handle($request, Closure $next)
    {
        if( $lang = session('lang')){
			\App::setLocale($lang);
		}
		return $next($request);
    }
}

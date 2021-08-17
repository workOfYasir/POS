<?php

namespace App\Http\Middleware;

use Closure;


class InstallChecker
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
        if(env('APP_INSTALL') == 'NO'){
            return $next($request);
        }
        return redirect()->route('login');
    }
}

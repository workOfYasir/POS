<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class Installed
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
        try {
            //check the database connection for import the sql file
            DB::connection()->getPdo();
            return $next($request);
        } catch (\Exception $e) {
            return redirect()->route('install');
        }
    }
}

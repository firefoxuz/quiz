<?php

namespace App\Http\Middleware;

use Artisan;
use Closure;
use Illuminate\Http\Request;

class DisableCachingOnLocal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (app()->environment('local')) {
            Artisan::call('optimize:clear');
        }
        return $next($request);
    }
}

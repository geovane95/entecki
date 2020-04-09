<?php

namespace App\Http\Middleware;

use Closure;

class Check2
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {    if (auth()->user()->access_profile == 3)
        {
            return redirect()->route('upload_data.index');
        }
        return $next($request);
    }
}

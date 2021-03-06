<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->user()->access_profile == 2)
        {
            return redirect()->route('client-space.index');
        }
        
      
        return $next($request);
    }
}

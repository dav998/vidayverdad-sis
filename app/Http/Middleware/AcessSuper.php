<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AcessSuper
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
        //Auth::user()->hasAnyRole('super');
        if(Auth::user()->hasAnyRoles(['super', 'sistemas'])){
            return $next($request);
        }
        return redirect('home');
    }
}

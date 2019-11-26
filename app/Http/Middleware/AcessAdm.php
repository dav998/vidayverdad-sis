<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AcessAdm
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
        if(Auth::user()->hasAnyRoles(['administrador'])){
            return $next($request);
        }
        return redirect('home');
    }
}

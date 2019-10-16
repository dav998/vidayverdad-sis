<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AcessDir
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
        if(Auth::user()->hasAnyRoles(['direccion'])){
            return $next($request);
        }
        return redirect('home');
    }
}

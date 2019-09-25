<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AcessAdmin
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
        //Auth::user()->hasAnyRole('admin');
        if(Auth::user()->hasAnyRoles(['admin', 'sistemas'])){
            return $next($request);
        }
        return redirect('home');
    }
}

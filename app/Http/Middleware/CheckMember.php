<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckMember
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
        if(Auth::user()->level != 'customer') {
            return redirect('dashboard');
        }

        return $next($request);
    }
}

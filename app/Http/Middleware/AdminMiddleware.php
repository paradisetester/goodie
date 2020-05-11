<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleware
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
        if(Auth::user()->role == 'admin' OR Auth::user()->role == 'user')
        {
           return $next($request);
        }
        else
        {
            return redirect('/home')->with('status','You are not Allowed to Admin Dashboard');
        }

        
    }
}

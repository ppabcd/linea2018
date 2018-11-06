<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class GuruMiddleware
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
        $n = $next($request);
        if(Auth::user()->teacher_id == null){
            return redirect('/home');
        }
        return $n;
    }
}

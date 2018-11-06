<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;
class SiswaMiddleware
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
        if(Auth::user()->student_id == null){
            return redirect('/home');
        }
        return $n;
    }
}

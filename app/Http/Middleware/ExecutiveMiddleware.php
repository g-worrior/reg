<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExecutiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // 2 for executive
        if(Auth::check()){
            if(Auth::user()->role_as ==2){
                return $next($request);
            }
            else {
                return redirect('/login')->with('message', 'Access Denied! user not executive');
            }
        }
        else{
            return redirect('/login')->with('message', 'Please Login First');
        }
    }
}

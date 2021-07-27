<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

        // role 1 = User
        if(Auth::user()->roles == 1){
            return redirect()->route('user');
        }

        // role 2 = Admin

        if(Auth::user()->roles == 2){
            return $next($request);
        }

        // role 3 = Manager
        if (Auth::user()->roles == 3) {
            return redirect()->route('manager');
        }
    }
}

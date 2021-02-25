<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class status
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
        if (Session::get('status')=='admin' || Session::get('status')=='anggota' && Session::get('login')==true) {
            return $next($request);
        }else {
            return redirect('/login');
        }
        
    }
}

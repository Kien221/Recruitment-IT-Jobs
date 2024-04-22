<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class loginAdmin
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
        if(EMPTY(session()->has('admin_id'))){

            return redirect()->route('login.admin');
        }
        return $next($request);
    }
}

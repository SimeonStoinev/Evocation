<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed | Redirector
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()['rank'] !== 'admin') {
            if (Auth::check()) {
                return redirect('/home');
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}

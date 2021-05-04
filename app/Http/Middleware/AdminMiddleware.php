<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Hash;
class AdminMiddleware
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
        if(Hash::check('logged-token', $request->session()->get('secret'))){
             return $next($request);
        }

        return redirect('login');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = session()->get('auth');
        if (!$auth) {
            return redirect('/')->with('error', 'Not authorize');
        }
        $user = session()->get('user');
        if(!$user){
            return redirect('/')->with('error', 'Not authorize');
        }
        $token = session()->get('token');
        if(!$token){
            return redirect('/')->with('error', 'Not authorize');

        }
        $request->token = $token;
        $request->user = $user;

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            return redirect('/')->with('error', 'Not authorized');
        }
        $user = session()->get('user');
        if (!$user) {
            return redirect('/')->with('error', 'Not authorized');
        }
        $token = session()->get('token');
        if (!$token) {
            return redirect('/')->with('error', 'Not authorized');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('http://127.0.0.1:3000/api/auth/me');

        $data = json_decode($response->body());

        if (!isset($data->id)) {
            return redirect('/')->with('error', 'Not authorized');
        }


        $request->token = $token;
        $request->user = $user;

        return $next($request);
    }
}

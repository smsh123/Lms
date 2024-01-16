<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckJwt
{
    public function handle($request, Closure $next)
    {
        $token = $request->cookie('login_token');

        if ($token) {
            try {
                $user = JWTAuth::parseToken()->authenticate();

                if ($user) {
                    Auth::login($user);
                }
            } catch (\Exception $e) {
                // Token is invalid or expired
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use App\Models\User;


class CheckJwt
{
    public function handle($request, Closure $next)
    {
        $staticToken = $request->cookie('login_token');
        if ($staticToken) {
            $token = new Token($staticToken);
            try {
                $payload = JWTAuth::decode($token);
                $data = $payload->get();
                $email = $data['email'] ?? '';
                $user = User::where('email', $email)->first();
                if ($user) {
                    Auth::login($user);
                }
            } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                // return response()->json(['message' => 'Token has expired'], 401);
            } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                // return response()->json(['message' => 'Token is invalid'], 401);
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                // return response()->json(['message' => 'Token parsing failed'], 401);
            }
        }

        return $next($request);
    }
}

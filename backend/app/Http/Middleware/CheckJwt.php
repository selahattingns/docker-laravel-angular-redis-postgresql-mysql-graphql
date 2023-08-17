<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class CheckJwt
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            throw new HttpResponseException(response()->json([
                "message" => "JWT authentication failed"
            ])->setStatusCode(401));
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param AuthRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRegisterRequest $request)
    {
        $user = new User([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    /**
     * @param AuthLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = Auth::guard('api')->attempt($credentials))
            return response()->json(['error' => 'Unauthorized'], 401);

        return $this->respondWithToken($token);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkToken()
    {
        return response()->json(['message' => 'Token is valid']);
    }

    /**
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }
}

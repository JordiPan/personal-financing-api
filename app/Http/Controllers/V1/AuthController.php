<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //php artisan route:cache
    public function login(LoginRequest $request, JwtService $jwt) {
        $loginInfo = $request->validated();
        if (!Auth::attempt($loginInfo)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();

        $accessToken = $jwt->generateAccessToken($user->id);
        $refreshToken = $jwt->generateRefreshToken($user->id);
        return response()->json([
            'message' => "Login!",
            'user' => $user,
            'access_token' => $accessToken
        ], 200)
        ->cookie('refresh_token',
            $refreshToken, 60 * 24 * 14, '/', null, env('APP_ENV') !== 'local', true, false, 'None');
    }
    public function logout(LoginRequest $request) { 
        return response()->json([
            'message' => "Logged out!"
        ])
        ->cookie('refresh_token', 
        '', -1, '/', null, env('APP_ENV') !== 'local', true, false, 'None');
    }
    public function register(RegisterRequest $request) { 
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']); 

        User::create($validatedData);
        // $token = $user->createToken();
        return response()->json([
            "message" => "user created"
    ], 200);
    }

    public function refresh(Request $request, JwtService $jwt) {
        $refreshToken = $request->cookie('refresh_token');
        if (!$refreshToken) {
            return response()->json(['message' => 'No refresh token'], 401);
        }

        try {
            $decoded = $jwt->decode($refreshToken);
            $accessToken = $jwt->generateAccessToken($decoded->sub);

            return response()->json(['message'=> 'refreshed!', 'access_token' => $accessToken]);
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Invalid refresh token'], 401);
        }
    }
}

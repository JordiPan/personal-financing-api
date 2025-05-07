<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\Request;
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
        $secure = env('APP_ENV') !== 'local' || request()->secure();
        
        // For SameSite=None, secure MUST be true
        if ($secure === false && request()->header('Origin') !== null) {
            $secure = true; // Force secure for cross-origin requests with SameSite=None
        }
        return response()->json([
            'message' => "Login!",
            'access_token' => $accessToken,
            'role' => $user->role 
        ], 200)
        ->withCookie(cookie('refresh_token',
            $refreshToken, 60 * 24 * 14, '/', null, $secure, true, false, 'None'));
    }
    public function logout(LoginRequest $request) { 
        return response()->json([
            'message' => "Logged out!"
        ])
        ->withCookie(cookie('refresh_token', 
        '', -1, '/', null, true, true, false, 'None'));
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
            return response()->json(['message' => 'No refresh token'], 403);
        }
        try {
            $decoded = $jwt->decode($refreshToken);
            $user = User::find($decoded->sub);
            $accessToken = $jwt->generateAccessToken($decoded->sub);
            return response()->json([
                'message'=> 'refreshed!', 
                'access_token' => $accessToken,
                'role'=>$user->role
            ]);
        }
        catch(\Exception $e) {
            return response()->json(['message' => 'Invalid refresh token'], 401);
        }
    }
}

<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $loginInfo = $request->validated();
        if (!Auth::attempt($loginInfo)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();
        //red but just a code editor error on createtoken
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }
    public function logout(LoginRequest $request) { 

    }
    public function register(RegisterRequest $request) { 
        $validatedData = $request->validated();
        $validatedData['password'] = Hash::make($validatedData['password']); 

        $user = User::create($validatedData);
        // $token = $user->createToken();
        return response()->json([
            "message" => "user created",
            "user" => $user,
            "token" => "token"
    ]);
    }
}

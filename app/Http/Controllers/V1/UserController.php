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

class UserController
{
    /**
     * Display a listing of the resource.
     * /api/v1/users/
     * auth::user gets set at jwtmiddleware with refresh
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        //checks with simple gate in appservicesprovider.php
        if( !$user->can('viewAny', User::class)) {
            return response()->json(['message'=> 'no admin priv'], 401);
        }
        $users = User::all();
        return response()->json($users, 200);
    }
    /**
     * Store a newly created resource in storage.
     * POST /api/v1/users/
     */
    public function store(Request $request)
    {
        return response()->json(['message'=>'path does not exist'],404);
    }

    /**
     * Display the specified resource.
     * /api/v1/users/{id}
     * auto gets user with userid in background
     */
    public function show(User $user)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        //checks with simple gate in appservicesprovider.php
        if( !$currentUser || !$currentUser->can('view', $user)) {
            return response()->json(['message'=> 'no privileges'], 401);
        }
        //TODO: use DTO/resource here later
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // ILL DO IT LATER
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['deleted!'],200);
    }
}

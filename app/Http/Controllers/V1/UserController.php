<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController
{
    /**
     * Display a listing of the resource.
     * /api/v1/users/
     * auth::user gets set at jwtmiddleware with refresh
     * automatically gets user with userid in background for some routes
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        //checks with simple gate in appservicesprovider.php
        if (!$user->can('viewAny', User::class)) {
            return response()->json(['message' => 'no admin priv'], 403);
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
        return response()->json(['message' => 'path does not exist'], 404);
    }

    /**
     * Display the specified resource.
     * /api/v1/users/{id}
     */
    public function show(User $user)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        //checks with simple policy
        if (!$currentUser->can('view', $user)) {
            return response()->json(['message' => 'no privileges'], 403);
        }
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $newUserInfo = $request->validated();
        //this gets done in updaterequest class
        // $currentUser = Auth::user();
        // if (!$currentUser || !$currentUser->can('update', $user)) {
        //     return response()->json(['message' => 'Cannnot update other user than self'], 403);
        // }

        $user->update($newUserInfo);
        return response()->json(['message' => 'Updated!', 'user'=> $newUserInfo], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'deleted!'], 200)->withCookie(cookie(
            'refresh_token',
            '',
            -1,
            '/',
            null,
            true,
            true,
            false,
            'None'
        ));;
    }
}

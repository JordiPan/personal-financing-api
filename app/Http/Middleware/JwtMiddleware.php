<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     * Basically does authorization with access token and adds user to Auth class laravel
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Missing token'], 403);
        }
        $token = substr($authHeader, 7);
        try {
            $payload = app(\App\Services\JwtService::class)->decode($token);

            $user = User::find($payload->sub);
            if (!$user) {
                return response()->json(['message' => 'No user found?'], 404);
            }
            //correct, but IDE doesn't know that the types are correct
            auth()->setUser($user);
        } catch (\Exception $e) {
            //i should test if this response triggers automatic refresh
            return response()->json(['message' => 'Invalid or expired token'], 401);
        }
        return $next($request);
    }
}

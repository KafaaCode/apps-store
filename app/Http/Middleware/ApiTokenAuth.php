<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ApiTokenAuth
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-TOKEN');

        if (!$token) {
            return response()->json(['message' => 'API token required'], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid API token'], Response::HTTP_UNAUTHORIZED);
        }

        Auth::setUser($user);

        return $next($request);
    }
}

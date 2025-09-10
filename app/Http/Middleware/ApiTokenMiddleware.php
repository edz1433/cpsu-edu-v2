<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiTokenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check token in header or query
        $token = $request->bearerToken() ?? $request->query('api_token');

        // Compare with your secret token (set in .env)
        if (!$token || $token !== env('API_SECRET_TOKEN')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

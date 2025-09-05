<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visit;

class TrackVisit
{
    public function handle(Request $request, Closure $next)
    {
        // Always create a new visit for this page load
        Visit::create([
            'page'        => $request->path(),
            'ip_address'  => $request->ip(),
            'session_id'  => session()->getId(), // still track session for online count
            'user_agent'  => $request->header('User-Agent'),
            'last_seen_at'=> now(),
        ]);

        return $next($request);
    }
}

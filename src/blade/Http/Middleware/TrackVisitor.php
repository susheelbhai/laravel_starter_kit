<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;

class TrackVisitor
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();

        // Only log once per day per IP (optional)
        $alreadyVisited = Visitor::where('ip_address', $ip)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if (!$alreadyVisited) {
            Visitor::create(['ip_address' => $ip]);
        }

        return $next($request);
    }
}

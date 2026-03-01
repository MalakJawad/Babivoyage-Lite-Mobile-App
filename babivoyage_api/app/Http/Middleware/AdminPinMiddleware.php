<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminPinMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $pin = $request->header('X-ADMIN-PIN');
        if ($pin !== '741852963') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return $next($request);
    }
}
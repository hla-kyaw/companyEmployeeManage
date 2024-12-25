<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role === 'Administrator' || auth()->user()->role === 'User') {
        	//dd('saddd');
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden'], 403);
    }
}


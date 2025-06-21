<?php 
namespace App\Http\Middleware;

use Closure;

class IsUser {
    public function handle($request, Closure $next) {
        if (auth()->user()->role !== 'user') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}
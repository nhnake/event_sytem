<?php 
namespace App\Http\Middleware;

use Closure;

class IsAdmin {
    public function handle($request, Closure $next) {
        if (auth()->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        return $next($request);
    }
}

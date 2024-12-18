<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('employer')->check()) {
            return redirect()->route('employer.login');
        }
        return $next($request);
    }
}
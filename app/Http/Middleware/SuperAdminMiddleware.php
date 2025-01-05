<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has the 'super_admin' role
        if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role !== 'super_admin') {
            return redirect()->route('admin.dashboard')->withErrors(['error' => 'Unauthorized access.']);
        }

        return $next($request);
    }
}

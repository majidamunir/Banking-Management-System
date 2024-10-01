<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $roles)
    {
        $roles = explode('|', $roles);

        if (Auth::check() && (Auth::user()->role === 'admin' || in_array(Auth::user()->role, $roles))) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'You do not have access to this page.');
    }
}


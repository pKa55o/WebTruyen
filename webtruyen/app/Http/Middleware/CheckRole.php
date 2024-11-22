<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Chia sẻ biến với layout.blade.php
            view()->share('userRole', Auth::user()->role);
        }

        return $next($request);
    }
}
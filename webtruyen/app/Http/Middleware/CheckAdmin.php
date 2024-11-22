<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle($request, Closure $next)
    // {
    //     $user = Auth::user();
    //     if ($user && $user->role === 'admin') {
    //         return redirect()->route('admin.home'); // Chuyển hướng đến admin dashboard
    //     }

    //     return redirect('/');
    // }
    public function handle($request, Closure $next)
{
    if (Auth::check() && Auth::user()->role === 'admin') {
        return $next($request);
    }

    // Chỉ chuyển hướng về một trang không phải admin (vd: /home)
    return redirect('/home');
}
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->role !== $role) {
            if ($user->role === 'admin') {
                return redirect('/admin/home');
            } elseif ($user->role === 'student') {
                return redirect('/student/home');
            } elseif ($user->role === 'lecturer') {
                return redirect('/lecturer/home');
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        if (in_array(Auth::user()->role, $role)) {
            return $next($request);
        }

        // Redirect users to a valid route or page when they don't have the required role
        return redirect()->route('home')->with('warning', 'Anda tidak punya akses!');
    }
}

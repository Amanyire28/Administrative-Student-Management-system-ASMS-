<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckPasswordChange
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->must_change_password) {
            // Allow access to password change page, logout, and dashboard redirect
            if (!$request->is('profile/force-password-change') &&
                !$request->is('logout') &&
                !$request->is('dashboard')) {
                return redirect()->route('profile.force-password-change');
            }
        }

        return $next($request);
    }
}

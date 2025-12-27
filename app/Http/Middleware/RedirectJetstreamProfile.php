<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectJetstreamProfile
{
    public function handle(Request $request, Closure $next)
    {
        // Redirect Jetstream's /user/profile to our custom profile
        if ($request->is('user/profile') && $request->isMethod('GET')) {
            return redirect()->route('profile.edit');
        }

        // Redirect Jetstream's profile update to our custom one
        if ($request->is('user/profile-information') && $request->isMethod('PUT')) {
            // We'll handle this differently - see Step 5
        }

        return $next($request);
    }
}

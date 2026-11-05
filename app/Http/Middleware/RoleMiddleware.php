<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role;

        // Check if the user's role is in the allowed roles list
        if (! in_array($userRole, $roles)) {
            // Redirect based on role to their appropriate dashboard, or abort if unauthorized
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($userRole === 'farmer') {
                return redirect()->route('farmer.dashboard');
            } elseif ($userRole === 'buyer') {
                return redirect()->route('buyer.dashboard');
            }

            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

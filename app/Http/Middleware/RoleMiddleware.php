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
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login')
                ->withErrors(['You must be logged in to access this page.']);
        }

        $userRole = $request->user()->role;

        if (!in_array($userRole, $roles)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

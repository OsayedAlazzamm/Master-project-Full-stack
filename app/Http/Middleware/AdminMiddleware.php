<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        if (!str_starts_with($request->path(), 'admin')) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()) {
            return redirect()->route('login')->withErrors(['Invalid credentials']);
        }

        if (auth()->user()->role_id != 1) {
            return redirect()->back()->withErrors(['Invalid credentials']);
        }

        return $next($request);
    }
}

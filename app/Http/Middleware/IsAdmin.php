<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{

public function handle(Request $request, Closure $next): Response
{
    // Check if user logged in
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Check if user is admin
    if (Auth::user()->isAdmin()) {
        return $next($request);
    }

    // If logged in but not admin
    return redirect()->route('public.index'); // or abort(403)
}
}

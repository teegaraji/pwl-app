<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthenticatedWithToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('refreshToken')) {
            return redirect()->route('login.form')->with('error', 'Anda harus login dulu.');
        }

        return $next($request);
    }
}

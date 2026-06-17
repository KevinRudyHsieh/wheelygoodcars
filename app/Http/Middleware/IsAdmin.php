<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check of de gebruiker is ingelogd én de admin-status heeft
        if (auth()->check() && auth()->user()->is_admin == 1) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Je hebt geen toegang tot deze pagina.');
    }
}

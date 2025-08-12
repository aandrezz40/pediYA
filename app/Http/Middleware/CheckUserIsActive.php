<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserIsActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || !$user->is_active) {
            // Puedes redirigir o lanzar un error
            auth()->logout();

            return redirect()->route('login')->withErrors([
                'account' => 'Tu cuenta está inactiva. Contacta con soporte.'
            ]);
        }

        return $next($request);
    }
}

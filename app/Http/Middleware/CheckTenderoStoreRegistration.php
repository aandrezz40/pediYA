<?php

namespace App\Http\Middleware;

use App\Helpers\TenderoStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenderoStoreRegistration
{
    /**
     * Handle an incoming request.
     * Solo valida si el tendero necesita registrar su tienda (active = 2)
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Verificar que el usuario esté autenticado y sea tendero
        if (!$user || $user->role !== 'tendero') {
            return redirect()->route('login');
        }

        // Solo validar si active = 2 (pendiente de registro de tienda)
        if ($user->active == TenderoStatus::PENDING_STORE_REGISTRATION) {
            // Rutas permitidas cuando falta registrar tienda
            $allowedRoutes = [
                'tendero.registroTienda',
                'tendero.storeRegistroTienda',
                'logout',
                'profile.edit',
                'profile.update'
            ];

            $currentRoute = $request->route()->getName();
            
            // Si intenta acceder a una ruta no permitida, redirigir al registro
            if (!in_array($currentRoute, $allowedRoutes)) {
                return redirect()->route('tendero.registroTienda')
                    ->with('warning', 'Debes completar el registro de tu tienda antes de continuar.');
            }
        }

        return $next($request);
    }
} 
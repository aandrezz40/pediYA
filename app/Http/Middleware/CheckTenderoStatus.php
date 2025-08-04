<?php

namespace App\Http\Middleware;

use App\Helpers\TenderoStatus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenderoStatus
{
    /**
     * Handle an incoming request.
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

        // Si el tendero tiene active = 2, significa que no ha registrado su tienda
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

        // Si el tendero tiene active = 1, está activo y puede acceder a todo
        if ($user->active == TenderoStatus::ACTIVE) {
            return $next($request);
        }

        // Si tiene active = 0 (pendiente) o 3 (suspendido), redirigir con mensaje
        if ($user->active == TenderoStatus::PENDING_APPROVAL || $user->active == TenderoStatus::SUSPENDED) {
            $message = $user->active == TenderoStatus::PENDING_APPROVAL 
                ? 'Tu cuenta está pendiente de aprobación. Contacta al administrador.'
                : 'Tu cuenta está suspendida. Contacta al administrador.';
                
            return redirect()->route('home')->with('error', $message);
        }

        return $next($request);
    }
} 
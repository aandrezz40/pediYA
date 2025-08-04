<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTenderoStoreStatus
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

        // Obtener la tienda del usuario
        $store = $user->store;
        
        if (!$store) {
            return redirect()->route('tendero.registroTienda')
                ->with('error', 'No se encontró información de tu tienda. Por favor, completa el registro.');
        }

        // Verificar estado de la tienda
        if (!$store->is_active || $store->status === 'disapproved' || $store->status === 'pending_approval') {
            // Rutas permitidas cuando la tienda está en estado no válido
            $allowedRoutes = [
                'homeTendero',
                'logout',
                'profile.edit',
                'profile.update'
            ];

            $currentRoute = $request->route()->getName();
            
            // Si intenta acceder a una ruta no permitida, redirigir al home
            if (!in_array($currentRoute, $allowedRoutes)) {
                $statusMessage = $this->getStoreStatusMessage($store);
                return redirect()->route('homeTendero')
                    ->with('error', $statusMessage);
            }
        }

        return $next($request);
    }

    /**
     * Obtener mensaje de estado de la tienda
     */
    private function getStoreStatusMessage($store): string
    {
        if (!$store->is_active) {
            return 'Tu tienda está inactiva. No puedes acceder a esta funcionalidad. Contacta al administrador para más información.';
        }
        
        switch ($store->status) {
            case 'disapproved':
                return 'Tu tienda fue desaprobada. No puedes acceder a esta funcionalidad. Contacta al administrador para más información.';
            case 'pending_approval':
                return 'Tu tienda está pendiente de aprobación. No puedes acceder a esta funcionalidad hasta que sea aprobada.';
            default:
                return 'Tu tienda tiene un estado no válido. No puedes acceder a esta funcionalidad. Contacta al administrador.';
        }
    }
} 
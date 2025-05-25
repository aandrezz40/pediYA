<?php

namespace App\Http\Middleware; // <-- ¡Este namespace es CRUCIAL!

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Usaremos Auth para un acceso más limpio al usuario
use App\Models\User; // Asegúrate de que el modelo User esté importado si lo necesitas directamente

class CheckUserRole // <-- ¡Este nombre de clase debe ser EXACTO!
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles Los roles permitidos (ej. 'admin', 'tendero')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Verifica si hay un usuario autenticado
        if (! Auth::check()) { // Usa Auth::check()
            return redirect('/login'); // Redirige al login si no está autenticado
        }

        // 2. Obtiene el usuario autenticado
        $user = Auth::user(); // Usa Auth::user() para obtener el usuario

        // 3. Verifica si el rol del usuario está en la lista de roles permitidos
        // 'role' es una columna de tipo string/enum en tu tabla de usuarios.
        if (! in_array($user->role, $roles)) {
            // Si el usuario no tiene el rol permitido, devuelve un error 403
            abort(403, 'Acceso no autorizado. Tu rol no es permitido para esta sección.');
        }

        // Si el usuario tiene el rol correcto, permite que la solicitud continúe
        return $next($request);
    }
}
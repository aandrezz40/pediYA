<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Obtener todas las notificaciones del usuario autenticado
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()->paginate(10);
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $user->unreadNotifications()->count()
        ]);
    }

    /**
     * Marcar una notificación como leída
     */
    public function markAsRead($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->markAsRead();
        
        return response()->json([
            'message' => 'Notificación marcada como leída',
            'unread_count' => $user->unreadNotifications()->count()
        ]);
    }

    /**
     * Marcar todas las notificaciones como leídas
     */
    public function markAllAsRead()
    {
        $user = Auth::user();
        $user->unreadNotifications()->update(['read_at' => now()]);
        
        return response()->json([
            'message' => 'Todas las notificaciones marcadas como leídas',
            'unread_count' => 0
        ]);
    }

    /**
     * Eliminar una notificación
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail($id);
        $notification->delete();
        
        return response()->json([
            'message' => 'Notificación eliminada',
            'unread_count' => $user->unreadNotifications()->count()
        ]);
    }

    /**
     * Obtener el conteo de notificaciones no leídas
     */
    public function unreadCount()
    {
        $user = Auth::user();
        return response()->json([
            'unread_count' => $user->unreadNotifications()->count()
        ]);
    }
}

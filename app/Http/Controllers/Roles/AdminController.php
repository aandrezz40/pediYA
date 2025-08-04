<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Obtener tiendas con usuario y dirección
        $stores = Store::with(['user.address'])->get();
        
        // Obtener usuarios con dirección y estadísticas
        $users = User::with(['address', 'store', 'orders'])->get();
        
        return view('admin.homeAdmin', compact('stores', 'users'));
    }

    public function getTienda($id)
    {
        $store = Store::with(['user.address', 'paymentMethods'])->findOrFail($id);
        
        // Agregar métodos de pago formateados
        $store->payment_methods_formatted = $store->paymentMethods->pluck('name')->implode(', ');
        
        return response()->json($store);
    }

    public function getUsuario($id)
    {
        $user = User::with(['address', 'store', 'orders'])->findOrFail($id);
        
        // Agregar estadísticas
        $user->stores_count = $user->store ? 1 : 0;
        $user->orders_count = $user->orders->count();
        $user->total_sales = $user->orders->sum('total_amount');
        
        return response()->json($user);
    }

    // Métodos para gestión de tiendas
    public function aprobarTienda($id)
    {
        try {
            $store = Store::findOrFail($id);
            $store->status = 'approved';
            $store->save();

            return response()->json([
                'success' => true,
                'message' => 'Tienda aprobada exitosamente',
                'status' => 'approved'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al aprobar la tienda: ' . $e->getMessage()
            ], 500);
        }
    }

    public function desaprobarTienda($id)
    {
        try {
            $store = Store::findOrFail($id);
            $store->status = 'disapproved';
            $store->save();

            return response()->json([
                'success' => true,
                'message' => 'Tienda desaprobada exitosamente',
                'status' => 'disapproved'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al desaprobar la tienda: ' . $e->getMessage()
            ], 500);
        }
    }

    public function activarTienda($id)
    {
        try {
            $store = Store::findOrFail($id);
            $store->is_active = true;
            $store->save();

            return response()->json([
                'success' => true,
                'message' => 'Tienda activada exitosamente',
                'is_active' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al activar la tienda: ' . $e->getMessage()
            ], 500);
        }
    }

    public function desactivarTienda($id)
    {
        try {
            $store = Store::findOrFail($id);
            $store->is_active = false;
            $store->save();

            return response()->json([
                'success' => true,
                'message' => 'Tienda desactivada exitosamente',
                'is_active' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al desactivar la tienda: ' . $e->getMessage()
            ], 500);
        }
    }

    // Métodos para gestión de usuarios
    public function activarUsuario($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_active = true;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Usuario activado exitosamente',
                'is_active' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al activar el usuario: ' . $e->getMessage()
            ], 500);
        }
    }

    public function desactivarUsuario($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->is_active = false;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Usuario desactivado exitosamente',
                'is_active' => false
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al desactivar el usuario: ' . $e->getMessage()
            ], 500);
        }
    }
}

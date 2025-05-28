<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;

class FavoriteController extends Controller
{
    public function unfavorite(Store $store, Request $request)
    {
        $user = $request->user();

        // Verifica que el usuario tenga la relación
        if ($user->favoriteStores()->where('store_id', $store->id)->exists()) {
            $user->favoriteStores()->detach($store->id);
            return response()->json(['success' => true, 'store_id' => $store->id]);
        }

        return response()->json(['success' => false, 'message' => 'Store not favorited'], 400);
    }


    public function favorite(Store $store, Request $request)
    {
        $user = auth()->user(); // Obtenemos el usuario autenticado

        // Relación muchos a muchos: usuario -> tiendas favoritas
        $user->favoriteStores()->syncWithoutDetaching([$store->id]);

        return response()->json(['success' => true]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function unfavorite(Store $store, Request $request)
{
    try {
        $user = $request->user();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        if ($user->favoriteStores()->where('store_id', $store->id)->exists()) {
            $user->favoriteStores()->detach($store->id);
            return response()->json(['success' => true, 'store_id' => $store->id]);
        }

        return response()->json(['success' => false, 'message' => 'Store not favorited'], 400);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}
}

<?php

namespace App\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class ClienteController extends Controller
{
    public function index(){   
        $user = auth()->user();
        $user->load('address');

        $favoriteStores = $user->favoriteStores()->with('user')->get(); 
        $stores = Store::where('address_neighborhood', $user->address->neighborhood ?? null)->get();

        
        return view('cliente.homeCliente', compact('favoriteStores','stores'));
    }

    public function detallesTienda($id){ 

        $store = Store::findOrFail($id);
        $owner = User::findOrFail($store->user_id);
        $products = Product::where('category_id', $id ?? null)->get();
        $categories = Category::where('store_id', $id ?? null)->get();


        return view('cliente.detallesTienda', compact('store', 'owner', 'products', 'categories'));
    }

    public function product($id, $idTienda, Request $request){

        if ($id == 0) {
            $store = Store::findOrFail($idTienda);
            $categories = Category::where('store_id', $idTienda ?? null)->get();
            $products = Product::where('store_id', $idTienda ?? null)->get();


            // Opcional: puedes retornar HTML o JSON
            return response()->json([
                'success' => true,
                'products' => $products
            ]);
        }else{
            // Encuentra la categoría seleccionada
            $category = Category::findOrFail($id);

            // Obtiene los productos de esa categoría
            $products = Product::where('category_id', $category->id)->get();

            // Opcional: puedes retornar HTML o JSON
            return response()->json([
                'success' => true,
                'products' => $products
            ]);
        }

    }

        public function busquedaTienda(Request $request){ 

        $nombre = $request->input('nameStore');

        $store = Store::whereRaw("name COLLATE utf8mb4_general_ci LIKE ?", ["%{$nombre}%"])->first();


        if (!$store) {
            return redirect()->back()->with('error', 'Tienda no encontrada.');
        }

        $owner = User::findOrFail($store->user_id);

        $categories = Category::where('store_id', $store->id ?? null)->get();
        
        $products = Product::where('store_id', $store->id ?? null)->get();



        return view('cliente.detallesTienda', compact('store', 'owner', 'products', 'categories'));
    }
}

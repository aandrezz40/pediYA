<?php

namespace App\Http\Controllers\Roles;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Barrio;
use App\Models\Order;
use App\Models\OrderItem;

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
        $products = Product::where('store_id', $id ?? null)->get();
        $categories = Category::where('store_id', $id ?? null)->get();


        return view('cliente.detallesTienda', compact('store', 'owner', 'products', 'categories'));
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


    public function agregarProducto(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'store_id' => 'required|exists:stores,id',
            'cantidad' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        $product = Product::findOrFail($request->product_id);
        $storeId = $request->store_id;
        $cantidad = $request->cantidad;

        // Buscar orden activa del usuario con esa tienda
        $order = Order::where('user_id', $user->id)
            ->where('store_id', $storeId)
            ->whereIn('status', ['inactive', 'Pendiente'])
            ->first();

        if (!$order) {
            // Crear nueva orden
            $order = Order::create([
                'user_id' => $user->id,
                'store_id' => $storeId,
                'order_code' => uniqid('PED-'),
                'total_amount' => 0,
                'status' => 'inactive',
            ]);
        }

        $subtotal = $product->price * $cantidad;

        // Verificar si ya existe el producto en los ítems
        $item = $order->orderItems()
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            return response()->json(['mensaje' => 'El producto ya está en la orden.'], 409);
        }

        // Crear nuevo ítem
        $order->orderItems()->create([
            'product_id' => $product->id,
            'product_name' => $product->name,
            'unit_price' => $product->price,
            'quantity' => $cantidad,
            'subtotal' => $subtotal,
        ]);

        // Actualizar total de la orden
        $order->total_amount += $subtotal;
        $order->save();

        // Cargar todas las órdenes activas del usuario para el carrito
        $orders = Order::with(['store', 'orderItems.product'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['inactive', 'Pendiente'])
            ->get();

        $totalOrdersCount = $orders->count();
        $totalOrdersAmount = $orders->sum('total_amount');

        // Renderizar la vista parcial del carrito
        $carritoHtml = view('partials._carrito', [
            'orders' => $orders,
            'totalOrdersAmount' => $totalOrdersAmount,
            'totalOrdersCount' => $totalOrdersCount,
        ])->render();

        return response()->json([
            'mensaje' => 'Producto agregado correctamente.',
            'carritoHtml' => $carritoHtml,
            'totalCount' => $totalOrdersCount,
            'totalAmount' => number_format($totalOrdersAmount, 0)
        ]);
    }

    public function eliminarOrden(Order $order){
    // Asegúrate de que el usuario actual sea el dueño
    if ($order->user_id !== auth()->id()) {
        return response()->json(['mensaje' => 'No autorizado'], 403);
    }

    $order->delete(); // Elimina la orden y, si tienes relación en cascada, también los ítems

    return response()->json([
        'mensaje' => 'Orden eliminada correctamente',
        'order_id' => $order->id,
    ]);
    }




    public function perfil(){   
        $user = auth()->user();
        $user->load('address');
        $barrios = Barrio::all();
        
        return view('cliente.perfil', compact('user', 'barrios'));
    }

    public function updateUser(Request $request)
    {
        $user = auth()->user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'address_line_1' => 'nullable|string|max:255',
            'neighborhood' => 'nullable|string|max:255',
        ]);

        // Actualizar datos del usuario
        $user->update([
            'name' => $validatedData['name'],
            'phone_number' => $validatedData['phone_number'] ?? null,
            'email' => $validatedData['email'],
        ]);

        // Actualizar o crear dirección
        if ($user->address) {
            $user->address->update([
                'address_line_1' => $validatedData['address_line_1'] ?? null,
                'neighborhood' => $validatedData['neighborhood'] ?? null,
            ]);
        } else {
            $user->address()->create([
                'address_line_1' => $validatedData['address_line_1'] ?? null,
                'neighborhood' => $validatedData['neighborhood'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Información actualizada correctamente.');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'La contraseña actual no es correcta.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Tu contraseña ha sido actualizada.');
    }

    public function historialPedidos(){   
        $user = auth()->user();
        $user->load('address');
        
        $orders = $user->Orders()
            ->where('status', '!=', 'inactive')
            ->with(['orderItems.product.category', 'store'])
            ->get();

        return view('cliente.historialPedido', compact('user', 'orders'));
    }

    public function actualizarCantidad(Request $request, $id){

        $orderItem = OrderItem::findOrFail($id);
        $orderItem->quantity = $request->quantity;
        $orderItem->subtotal = $orderItem->unit_price * $request->quantity;
        $orderItem->save();

        return response()->json(['success' => true]);
    }

    public function verDetalle($orderId){
        $order = Order::with(['store', 'orderItems'])->findOrFail($orderId);

        return view('cliente.detallePedido', compact('order'));
    }

    public function confirmarPedido(Request $request){
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'customer_notes' => 'nullable|string|max:500',
        ]);

        $order = \App\Models\Order::findOrFail($request->order_id);
        $order->status = 'pendiente'; // O el valor correspondiente a "pendiente"
        $order->customer_notes = $request->customer_notes;
        $order->save();

        return redirect()->route('homeCliente')->with('success', 'Pedido confirmado correctamente.');
    }


}

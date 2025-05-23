<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Clave primaria única para cada ítem de pedido.
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula este ítem al `order` padre.
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula este ítem al `product` original.
            $table->string('product_name'); // El nombre del producto en el momento del pedido (para historial, si el producto cambia de nombre después).
            $table->decimal('unit_price', 10, 2); // El precio del producto al momento exacto de la compra.
            $table->integer('quantity'); // La cantidad de este producto específica en el pedido.
            $table->decimal('subtotal', 10, 2); // El subtotal de este ítem (precio_unitario * cantidad).
            $table->timestamps(); // `created_at` y `updated_at`.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema->dropIfExists('order_items');
    }
};

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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Clave primaria única para cada producto.
            $table->foreignId('store_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula el producto a la `store` que lo vende.
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // Clave foránea a la tabla `categories`. Si una categoría es eliminada, este campo se establece en NULL.
            $table->string('name'); // Nombre del producto, ej: "Leche Entera", "Pan Integral".
            $table->text('description')->nullable(); // Descripción detallada del producto (opcional).
            $table->decimal('price', 10, 2); // Precio unitario del producto (ej: 10.50). '10' dígitos en total, '2' decimales.
            $table->string('image_path')->nullable(); // Ruta del archivo de la imagen del producto (opcional).
            $table->boolean('is_available')->default(true); // Booleano para indicar si el producto está disponible (en stock) o agotado.
            $table->integer('stock')->nullable(); // Cantidad de unidades en stock del producto (opcional, para control de inventario).
            $table->timestamps(); // `created_at` y `updated_at`.
            $table->softDeletes(); // `deleted_at`: para borrado suave de productos.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
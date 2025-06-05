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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Clave primaria única para cada pedido.
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula el pedido al `user` (cliente) que lo realizó.
            $table->foreignId('store_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula el pedido a la `store` a la que se le hizo el pedido.
            $table->string('order_code')->unique(); // Un código único para el pedido, útil para seguimiento (ej: UUID o un hash).
            $table->decimal('total_amount', 10, 2); // El monto total del pedido incluyendo todos los ítems.
            $table->enum('status', ['inactive', 'pending', 'in_preparation', 'ready_for_pickup', 'completed', 'cancelled'])->default('pending'); // El estado actual del pedido en su ciclo de vida.
            $table->text('customer_notes')->nullable(); // Campo para que el cliente agregue notas o instrucciones adicionales al tendero.
            $table->timestamps(); // `created_at` y `updated_at`.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
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
        Schema::create('store_payment_method', function (Blueprint $table) {
            $table->foreignId('store_id')->constrained()->onDelete('cascade'); // Clave foránea a la tabla `stores`.
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade'); // Clave foránea a la tabla `payment_methods`.
            $table->primary(['store_id', 'payment_method_id']); // Define una clave primaria compuesta para asegurar la unicidad de cada par tienda-método de pago.
            $table->timestamps(); // `created_at` y `updated_at`.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_payment_method');
    }
};
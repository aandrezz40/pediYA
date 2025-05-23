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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Clave primaria única para cada categoría.
            $table->foreignId('store_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula la categoría a una `store`.
            $table->string('name'); // Nombre de la categoría, ej: "Verduras", "Carnes".
            $table->timestamps(); // `created_at` y `updated_at`.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
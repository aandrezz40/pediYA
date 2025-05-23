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
        Schema::create('store_favorites', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula al `user` (cliente).
            $table->foreignId('store_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula a la `store` marcada como favorita.
            $table->primary(['user_id', 'store_id']); // Clave primaria compuesta para asegurar que un cliente solo pueda marcar una tienda como favorita una vez.
            $table->timestamps(); // `created_at` y `updated_at`.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_favorites');
    }
};
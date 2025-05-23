<?php
// database/migrations/YYYY_MM_DD_HHMMSS_create_addresses_table.php

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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // Columna autoincremental, clave primaria única para cada dirección.
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula esta dirección a un `user`. `onDelete('cascade')` elimina las direcciones si el usuario es eliminado.
            $table->string('address_line_1'); // La parte principal de la dirección, ej: "Carrera 40 #86a13".
            $table->string('neighborhood'); // El barrio de la dirección, ej: "Las Granjas". Fundamental para la lógica de búsqueda de tiendas por cercanía.
            $table->boolean('is_default')->default(true); // Booleano para indicar si esta es la dirección predeterminada del usuario. Útil si un usuario guarda múltiples direcciones.
            $table->timestamps(); // `created_at` y `updated_at`: Marcas de tiempo automáticas.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
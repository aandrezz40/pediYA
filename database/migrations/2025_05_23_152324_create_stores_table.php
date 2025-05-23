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
        Schema::create('stores', function (Blueprint $table) {
            $table->id(); // Clave primaria única para cada tienda.
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clave foránea que vincula la tienda al `user` (tendero) que la posee.
            $table->string('name'); // Nombre público de la tienda.
            $table->string('logo_path')->nullable(); // Ruta del archivo del logo/imagen de perfil de la tienda (opcional).
            $table->text('description')->nullable(); // Una breve descripción de la tienda (opcional).
            $table->string('address_street'); // La dirección física exacta de la tienda, ej: "Calle 10 #20-30".
            $table->string('address_neighborhood'); // El barrio donde se encuentra la tienda, esencial para la búsqueda por cercanía del cliente.
            $table->string('schedule')->nullable(); // Horario de atención de la tienda, ej: "L-V 8 AM - 6 PM" (se puede refinar con una tabla de horarios si es necesario).
            $table->boolean('offers_delivery')->default(false); // Booleano para indicar si la tienda ofrece servicio de domicilio (fuera de PediYÁ).
            $table->string('delivery_contact_phone')->nullable(); // Número de teléfono para que los clientes coordinen el domicilio directamente con la tienda.
            $table->string('runt_number')->nullable(); // Número de RUNT de la tienda (campo legal/identificatorio).
            $table->string('chamber_of_commerce_registration')->nullable(); // Número de Registro de Cámara y Comercio (campo legal/identificatorio).
            $table->boolean('is_open')->default(false); // Indica el estado actual de la tienda (Abierta/Cerrada) para recibir pedidos.
            $table->enum('status', ['pending_approval', 'approved', 'disapproved'])->default('pending_approval'); // Estado de aprobación de la tienda por parte de los administradores.
            $table->boolean('is_active')->default(true); // Control de activación/desactivación de la tienda en la plataforma por el administrador.
            $table->timestamps(); // `created_at` y `updated_at`.
            $table->softDeletes(); // `deleted_at`: para borrado suave de tiendas.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
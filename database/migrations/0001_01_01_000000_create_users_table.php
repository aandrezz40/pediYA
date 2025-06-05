<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_users_table.php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Columna autoincremental, clave primaria única para cada usuario.
            $table->string('name'); // Nombre completo del usuario.
            $table->string('email')->unique(); // Correo electrónico del usuario, debe ser único para el inicio de sesión.
            $table->string('phone_number'); // Número de teléfono del usuario, opcional.
            $table->string('password'); // Contraseña encriptada del usuario para seguridad.
            $table->enum('role', ['cliente', 'tendero', 'admin'])->default('client'); // Define el rol del usuario (cliente, tendero, o administrador). 'client' es el rol por defecto.
            $table->boolean('is_active')->default(true); // Indica si la cuenta del usuario está activa o desactiva (para gestión del administrador).
            $table->timestamp('email_verified_at')->nullable(); // Marca de tiempo para registrar cuándo se verificó el correo electrónico del usuario (opcional si se implementa verificación).
            $table->rememberToken(); // Token para la funcionalidad "recordarme" en el inicio de sesión.
            $table->timestamps(); // `created_at` y `updated_at`: Marcas de tiempo automáticas para cuándo se creó y la última vez que se actualizó el registro.
            $table->softDeletes(); // `deleted_at`: Columna para implementar "borrado suave", lo que significa que los registros no se eliminan físicamente, solo se marcan como eliminados.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
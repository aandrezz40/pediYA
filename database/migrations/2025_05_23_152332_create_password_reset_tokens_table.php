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
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // El correo electrónico del usuario que solicitó el restablecimiento, sirve como clave primaria para el token.
            $table->string('token'); // El token único generado para el restablecimiento de contraseña.
            $table->timestamp('created_at')->nullable(); // La marca de tiempo de creación del token, usada para controlar su expiración.
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_reset_tokens');
    }
};
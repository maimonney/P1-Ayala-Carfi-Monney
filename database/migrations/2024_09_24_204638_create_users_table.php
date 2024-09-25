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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Cambia 'string' por 'id' para la clave primaria
            $table->string('name'); // Asegúrate de que tengas un campo para el nombre
            $table->string('email')->unique(); // Agrega la columna email
            $table->string('password'); // Asegúrate de que tengas un campo para la contraseña
            $table->string('role')->default('user'); // Si deseas un campo para el rol
            $table->timestamps(); // Agrega campos created_at y updated_at
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


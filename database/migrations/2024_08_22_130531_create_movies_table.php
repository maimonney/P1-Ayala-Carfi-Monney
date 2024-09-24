<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     /*
    Las migraciones son clases que heredan de la clase Migration de Laravel, y tienen 2 métodos:
    - up
        Acá escribimos el código del cambio que queremos hacer en la base de datos. Ej: crear una
        tabla.
    - down
        Acá escribimos el código que revierte el cambio que hicimos en el up. Ej: Si creamos una
        tabla en el up(), acá haremos el drop de esa tabla.
    */

    public function up(): void
    {
        /*
        Schema es la clase de Laravel para interactuar con el schema de la base de datos.
        Desde acá es donde podemos hacer creates, drops o alters de las tablas.
        El método create es el que se encarga de crear una tabla.
        Recibe 2 parámetros:
        1. String. El nombre de la tabla.
        2. Closure. Las instrucciones para crear la tabla. Acá pedimos como argumento una
            instancia de la clase Blueprint.

        La clase Blueprint (plano de construcción) tiene métodos para configurar cómo es
        la tabla, o lo que le queremos modificar.
        */
        Schema::create('movies', function (Blueprint $table) {
            // La función id() crea un campo que es en MySQL:
            //  BIGINT UNSIGNED NOT NULL AUTO_INCREMENT
            // Y por defecto, lleva el nombre "id".
            $table->id("movie_id");

            // Si queremos crear un campo que sea VARCHAR, podemos usar la función string().
            // Si no aclaramos la longitud con el segundo parámetro, se usa el default
            // configurado en el framework (por defecto: 255).
            $table->string('title', 100);
            $table->dateTime('release_date');
            // price => DOUBLE/FLOAT DECIMAL INT
            // Vamos a guardar el price como un INT UNSIGNED que contenga el precio en centavos.
            $table->unsignedInteger('price');
            $table->text('synopsis');

             // timestamps() crea dos campos:
            // - created_at TIMESTAMP NULL
            // - updated_at TIMESTAMP NULL
            // Estos campos tienen como objetivo llevar la fecha de creación y de última
            // actualización, respectivamente, del registro.
            // Si usamos Eloquent, estos campos se manejan automáticamente.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 255)->unique();
            $table->string('password');
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'Sofi',
                'email' => 'sofia.carafi@davinci.edu.ar',
                'password' => \Hash::make('password'),
                'role' => 'user',
                'created_at' => now(),
            ],
            [
                'name' => 'Mailen',
                'email' => 'mailen.monney@davinci.edu.ar',
                'password' => \Hash::make('123456'),
                'role' => 'admin',
                'created_at' => now()
            ],
            [
                'name' => 'Day',
                'email' => 'daiana.ayala@davinci.edu.ar',
                'password' => \Hash::make('day123'),
                'role' => 'admin',
                'created_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};


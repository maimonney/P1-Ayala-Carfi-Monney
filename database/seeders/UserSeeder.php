<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Sofia',
                'email' => 'sofia.carafi@davinci.edu.ar',
                'password' => Hash::make('sofi123'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mailen',
                'email' => 'mailen.monney@davinci.edu.ar',
                'password' => Hash::make('mai123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Day',
                'email' => 'daiana.ayala@davinci.edu.ar',
                'password' => Hash::make('day123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

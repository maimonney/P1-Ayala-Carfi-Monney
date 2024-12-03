<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Service; 

class UserSeeder extends Seeder
{

    public function run(): void
    {
        $services = Service::all(); 

        DB::table('users')->insert([
            [
                'name' => 'Sofia',
                'email' => 'sofia.carafi@davinci.edu.ar',
                'password' => Hash::make('sofi123'),
                'role' => 'user',
                'avatar' => 'img/sofi.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mailen',
                'email' => 'mailen.monney@davinci.edu.ar',
                'password' => Hash::make('mai123'),
                'role' => 'admin',
                'avatar' => 'img/Maimonney.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Day',
                'email' => 'daiana.ayala@davinci.edu.ar',
                'password' => Hash::make('day123'),
                'role' => 'admin',
                'avatar' => 'img/dayayalaa.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

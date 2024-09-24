<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service; // Asegúrate de importar el modelo Service

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::factory()->count(10)->create(); // Crea 10 servicios
    }
}

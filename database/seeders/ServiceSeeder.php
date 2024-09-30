<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'title' => 'Gestión de Redes Sociales',
                'description' => 'Se detalla cómo se gestionan las redes sociales y qué incluye el servicio.',
                'price' => 70000.00,
                'image' => 'img/servicio/disenadores-web-barcelona.jpg',
                'category' => 'Social Media',
                'duration' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Desarrollo de Sitio Web Personalizado',
                'description' => 'Servicios de desarrollo de sitios web personalizados que se adaptan a las necesidades específicas de tu negocio. Utilizo tecnologías modernas como HTML5, CSS3 y JavaScript, y frameworks como Vue.js para crear experiencias interactivas y responsivas. Además, me aseguro de que tu sitio web sea optimizado para SEO y fácil de administrar.',
                'price' => 10000.00,
                'image' => 'img/servicio/ux-ui.jpg',
                'category' => 'Desarrollo Web',
                'duration' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Diseño de Logo Personalizado',
                'description' => 'Servicios de diseño de logo personalizado que capturan la esencia de tu marca. A través de un proceso colaborativo, trabajo contigo para entender tu visión, valores y el mensaje que deseas transmitir. Utilizo herramientas de diseño gráfico avanzadas para crear logos únicos, atractivos y memorables que se adapten a diferentes plataformas y aplicaciones.',
                'price' => 20000.00,
                'image' => 'img/servicio/usos-del-diseno-grafico.jpg',
                'category' => 'Diseño Gráfico',
                'duration' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

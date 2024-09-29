<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->string('image')->nullable();
        $table->integer('duration')->nullable();
        $table->string('category');
        $table->timestamps();
    });

    DB::table('services')->insert([
        [
            'title' => 'Gestión de Redes Sociales',
            'description' => 'Se detalla cómo se gestionan las redes sociales y qué incluye el servicio.',
            'price' => 70000.00,
            'image' => 'img/servicio/disenadores-web-barcelona.jpg',
            'category' => 'Social Media',
            'duration' => 12,
            'created_at' => now(),
        ],
        [
            'title' => 'Desarrollo de Sitio Web Personalizado',
            'description' => 'Servicios de desarrollo de sitios web personalizados que se adaptan a las necesidades específicas de tu negocio. Utilizo tecnologías modernas como HTML5, CSS3 y JavaScript, y frameworks como Vue.js para crear experiencias interactivas y responsivas. Además, me aseguro de que tu sitio web sea optimizado para SEO y fácil de administrar.',
            'price' => 10000.00,
            'image' => 'img/servicio/ux-ui.jpg',
            'category' => 'Desarrollo Web',
            'duration' => 6,
            'created_at' => now(),
        ],
        [
            'title' => 'Diseño de Logo Personalizado',
            'description' => 'Sservicios de diseño de logo personalizado que capturan la esencia de tu marca. A través de un proceso colaborativo, trabajo contigo para entender tu visión, valores y el mensaje que deseas transmitir. Utilizo herramientas de diseño gráfico avanzadas para crear logos únicos, atractivos y memorables que se adapten a diferentes plataformas y aplicaciones. Ya sea que estés comenzando un nuevo negocio o buscando renovar tu imagen, estoy aquí para ayudarte a destacar en el mercado.',
            'price' => 20000.00,
            'image' => 'img/servicio/usos-del-diseno-grafico.jpg',
            'category' => 'Diseño Gráfico',
            'duration' => 2,
            'created_at' => now(),
        ],
    ]);
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

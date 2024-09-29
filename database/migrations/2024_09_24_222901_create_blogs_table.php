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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); 
            $table->string('title');
            $table->text('description');
            $table->text('content');
            $table->string('image')->nullable();
            $table->timestamp('published_at')->nullable(); 
            $table->foreignId('author_id')->constrained('users'); 
            $table->string('tags')->nullable();
            $table->timestamps(); 
        });

        DB::table('blogs')->insert([
        [
            'title' => 'Mejores Prácticas de Diseño Responsivo',
            'description' => 'Mejores Prácticas de Diseño Responsivo
Descripción: Descubre las mejores prácticas para crear sitios web que se adapten a cualquier dispositivo.',
            'content' => 'El diseño responsivo es una técnica esencial en la creación de sitios web que se adaptan a diferentes tamaños de pantalla y dispositivos, garantizando una experiencia de usuario óptima en móviles, tabletas y computadoras de escritorio. Para implementarlo, se pueden utilizar técnicas como el uso de unidades relativas (como porcentajes y ems), media queries en CSS y herramientas como frameworks como Bootstrap y Tailwind, que facilitan la creación de diseños flexibles y escalables. Además, es crucial realizar pruebas en varios dispositivos y optimizar el rendimiento para asegurar que el sitio no solo se vea bien, sino que también funcione de manera eficiente en todos ellos. Esto no solo mejora la estética, sino que también contribuye a una mejor usabilidad y satisfacción del usuario.',
            'image' => 'img/blog/mantenimiento-web-desing.jpg',
            'author_id' => 1,
            'tags' => 'diseño responsivo, Bootstrap, Tailwind, UX/UI',
            'created_at' => now(),
            'published_at' => now(),
        ],
        [
            'title' => 'Tendencias Actuales en Diseño Gráfico para Web',
            'description' => 'Explora las últimas tendencias en diseño gráfico para la web que están marcando la pauta en la creación de interfaces visualmente atractivas y efectivas.',
            'content' => 'El diseño gráfico para la web está en constante evolución, influenciado por avances tecnológicos y las necesidades cambiantes de los usuarios. Mantenerse actualizado con las tendencias es esencial para los diseñadores que buscan crear sitios web visualmente impactantes y funcionales. 
            El diseño gráfico web está constantemente cambiando, y seguir las tendencias actuales es fundamental para mantenerse relevante. Aplicar estas tendencias de manera consciente puede ayudar a crear sitios atractivos, innovadores y memorables.',
            'image' => 'img/blog/diseno-web.jpg',
            'author_id' => 2,
            'tags' => 'diseño gráfico, tendencias, web, minimalismo, ilustraciones',
            'created_at' => now(),
            'published_at' => now(),
        ],
        [
            'title' => 'Mejores Prácticas de UX/UI en Diseño Web',
            'description' => 'Aprende las mejores prácticas de UX/UI que garantizan una experiencia de usuario excepcional y un diseño visualmente atractivo en sitios web.',
            'content' => 'Los principios de diseño centrados en el usuario son esenciales. Es fundamental entender a la audiencia y sus necesidades, lo que incluye realizar investigaciones de usuarios y pruebas de usabilidad. La consistencia en el diseño, el uso adecuado de colores, tipografías y espacios en blanco, contribuyen a una interfaz atractiva y funcional.',
            'image' => 'img/blog/ui-ux.jpg',
            'author_id' => 3,
            'tags' => 'UX, UI, diseño web, mejores prácticas, experiencia del usuario',
            'created_at' => now(),
            'published_at' => now(),
        ],
        [
            'title' => 'La Influencia del Diseño en el Éxito de las Redes Sociales',
            'description' => 'Descubre cómo el diseño gráfico y la experiencia de usuario (UX/UI) influyen en el éxito de las redes sociales, desde la atracción visual hasta la retención de usuarios.',
            'content' => 'El diseño gráfico juega un papel crucial en el éxito de las redes sociales. La forma en que se presenta la interfaz, los elementos visuales y la experiencia del usuario son factores decisivos para atraer y retener usuarios en plataformas como Instagram, Facebook y TikTok. 
            Actualmente, las redes sociales adoptan tendencias como el minimalismo, el uso de microinteracciones (animaciones sutiles que mejoran la interacción) y la integración de elementos visuales 3D para ofrecer experiencias más inmersivas. 
            El diseño en redes sociales va más allá de la apariencia, impactando directamente en cómo los usuarios interactúan con la plataforma. Al aplicar principios de diseño gráfico y UX/UI, se puede mejorar significativamente la experiencia del usuario y el éxito de la plataforma.',
            'image' => 'img/blog/blog-aicad.jpg',
            'author_id' => 3,
            'tags' => 'redes sociales, diseño gráfico, UX/UI, microinteracciones, tendencias',
            'created_at' => now(),
            'published_at' => now(),
        ],
        [
            'title' => 'Neobrutalismo: La Nueva Estética en el Diseño Web',
            'description' => 'Descubre cómo el neobrutalismo está transformando el diseño web con su enfoque audaz y funcional, rompiendo las normas estéticas convencionales.',
            'content' => 'Los sitios web neobrutalistas utilizan colores vibrantes y tipografías sin serifas, creando paletas audaces que destacan. Se centran en el diseño funcional, con un enfoque en la simplicidad y la claridad. Además, incorporan elementos gráficos rústicos, como imágenes sin procesar y texturas ásperas, así como estructuras asimétricas que generan un impacto visual significativo.',
            'image' => 'img/blog/NeoBrutalismo.jpg',
            'author_id' => 2,
            'tags' => 'neobrutalismo, diseño web, tendencias, UX/UI, estética',
            'created_at' => now(),
            'published_at' => now(),
        ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

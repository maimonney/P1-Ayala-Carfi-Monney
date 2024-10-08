<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = \App\Models\Service::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'duration' => $this->faker->numberBetween(1, 6) . ' meses',
            'category' => $this->faker->randomElement([
                'Desarrollo Web',
                'Marketing',
                'Diseño Gráfico',
                'SEO',
                'Social Media',
                'Desarrollo de Apps'
            ]),
            'image' => 'default.png',
        ];
    }
}

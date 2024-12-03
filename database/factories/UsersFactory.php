<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Users>
 */
class UsersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), 
            'remember_token' => Str::random(10),
            'is_admin' => false, 
            'avatar' => $this->faker->imageUrl(200, 200, 'people', true),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Indicate that the model is an admin.
     *
     * @return static
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_admin' => true, 
        ]);
    }

    /**
     * Indicate a custom password for the user.
     *
     * @param string $password
     * @return static
     */
    public function withPassword(string $password): static
    {
        return $this->state(fn (array $attributes) => [
            'password' => Hash::make($password), 
        ]);
    }

//     public function definition(): array
// {
//     return [
//         'name' => $this->faker->name(),
//         'email' => $this->faker->unique()->safeEmail(),
//         'email_verified_at' => now(),
//         'password' => Hash::make('password'), 
//         'remember_token' => Str::random(10),
//         'role' => 'user', 
//     ];
// }

// // Indicar que el modelo es un admin.
// public function admin(): static
// {
//     return $this->state(fn (array $attributes) => [
//         'role' => 'admin', 
//     ]);
// }

}

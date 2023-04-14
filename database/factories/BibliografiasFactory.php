<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bibliografias>
 */
class BibliografiasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo'=>fake()->sentence(),
            'descripcion'=>fake()->paragraph(),
            'autor'=>fake()->name(),
            'anio'=>fake()->date(),
            'editorial'=>fake()->sentence(),
            'estatus'=>fake()->randomDigit(),
        ];
    }
}

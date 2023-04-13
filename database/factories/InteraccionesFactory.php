<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Interacciones>
 */
class InteraccionesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'interaccion'=>fake()->paragraph(),
            'id_farmaco'=>\App\Models\Farmacos::factory()->create()->id,
        ];
    }
}

<?php

namespace Database\Factories;
use App\Models\GrupoFarmaco;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farmacos>
 */
class FarmacosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'farmaco'=>fake()->name(),
            'mecanismo'=>fake()->sentence(),
            'public_id'=>fake()->randomDigit(),
            'url'=>fake()->url(),
            'efecto'=>fake()->sentence(),
            'id_grupo'=>\App\Models\GrupoFarmaco::factory()->create()->id,
            'status'=>1
        ];
    }
}

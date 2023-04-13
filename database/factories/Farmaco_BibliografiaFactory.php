<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Farmaco_Bibliografia>
 */
class Farmaco_BibliografiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'farmacos_id'=>\App\Models\Farmacos::factory()->create()->id,
            'bibliografias_id'=>\App\Models\Bibliografias::factory()->create()->id,
        ];
    }
}

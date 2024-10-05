<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Koperasi>
 */
class KoperasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->company(),
            "berdiri" => fake()->date(),
            'alamat' => fake()->address(),
            'hukum' => '0003967//BH/M.KUKM.2/IV/2017',
        ];
    }
}

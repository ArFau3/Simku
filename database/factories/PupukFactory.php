<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pupuk>
 */
class PupukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pupuk' => fake()->words(2, true),
            'jenis_pupuk' => fake()->name($jenis = "organik" | "non organik"),
            'harga' => fake()->numberBetween(100000, 5000000),
        ];
    }
}

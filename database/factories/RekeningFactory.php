<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rekening;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rekening>
 */
class RekeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomor_rekening1 = fake()->randomDigitNotNull();
        $nomor_rekening2 = fake()->randomDigitNotNull();
        $nomor_rekening3 = fake()->randomDigitNotNull();
        $induk = Rekening::whereNull('rekening_induk')->get();
        return [
            'nama' => fake()->unique()->word(),
            'nomor' => $nomor_rekening1.'.'.$nomor_rekening2.'.'.$nomor_rekening3,
            'rekening_induk' => $induk->random()->id,
        ];
    }
}

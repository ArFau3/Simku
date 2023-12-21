<?php

namespace Database\Factories;

use App\Models\Pupuk;
use App\Models\TahunSawit;
use App\Models\VarietasSawit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Petani>
 */
class PetaniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $varietas_sawit = VarietasSawit::all();
        $pupuk = Pupuk::all();
        $tahun_sawit = TahunSawit::all();

        return [
            'nama' => fake()->name(),
            'alamat' => fake()->address(),
            'no_hp' => fake()->phoneNumber(),
            'luas_lahan' => fake()->randomFloat(1, 1, 30),
            'varietas_sawit_id' => $varietas_sawit->random()->id,
            'pupuk_id' => $pupuk->random()->id,
            'tahun_sawit_id' => $tahun_sawit->random()->id,
        ];
    }
}

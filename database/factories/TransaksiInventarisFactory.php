<?php

namespace Database\Factories;

use App\Models\Rekening;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiInventaris>
 */
class TransaksiInventarisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transaksi = Rekening::all();
        return [
            'debit' => $transaksi->random()->id,
            'kredit' => $transaksi->random()->id,
            'jenis' => fake()->numberBetween(1, 8),
            'tanggal' => fake()->date(),
            'keterangan' => fake()->sentence(11),
            'nominal' => fake()->numberBetween(1000, 5000000),
        ];
    }
}

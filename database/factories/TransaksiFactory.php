<?php

namespace Database\Factories;

use App\Models\Rekening;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiInventaris>
 */
class TransaksiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transaksi = Rekening::whereNot(function (Builder $query) {
            $query->where('desimal', 3060000);
        })->get();
        return [
            'debit' => $transaksi->random()->id,
            'kredit' => $transaksi->random()->id,
            'jenis' => fake()->numberBetween(1, 8),
            'tanggal' => fake()->dateTimeBetween('-5 years', '0 week'),
            'keterangan' => fake()->sentence(11),
            'nominal' => fake()->numberBetween(1000, 5000000),
        ];
    }
}

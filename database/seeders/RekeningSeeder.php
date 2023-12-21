<?php

namespace Database\Seeders;

use App\Models\Rekening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rekening::insert([
        [
            'nama' => 'Aset Tetap',
            'nomor' => '1',
        ],[
            'nama' => 'Kewajiban',
            'nomor' => '2',
        ],[
            'nama' => 'Modal',
            'nomor' => '3',
        ],[
                'nama' => 'Pendapatan',
            'nomor' => '4',
        ],[
                'nama' => 'Beban',
            'nomor' => '5',
        ],
    ]);
        Rekening::factory(10)->create();
    }
}

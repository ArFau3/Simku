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
            'edit' => false,
            'nomor' => '1',
        ],[
            'nama' => 'Kewajiban',
            'edit' => false,
            'nomor' => '2',
        ],[
            'nama' => 'Modal',
            'edit' => false,
            'nomor' => '3',
        ],[
            'nama' => 'Pendapatan',
            'edit' => false,
            'nomor' => '4',
        ],[
            'nama' => 'Beban',
            'edit' => false,
            'nomor' => '5',
        ],
    ]);
        Rekening::factory(20)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Koperasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KoperasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Koperasi::insert(
            [
                'nama' => "Koperasi Unit Desa",
                'hukum' => '0003967//BH/M.KUKM.2/IV/2017',
                'logo' => "logo.png",
                'alamat' => 'Jl. Test',
            ]
        );
        Koperasi::factory(2)->create();
    }
}

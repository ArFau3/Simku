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
                'logo' => "\assets\logo.png",
            ]
        );
        Koperasi::factory(2)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VarietasSawit;

class VarietasSawitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VarietasSawit::factory(50)->create();
    }
}

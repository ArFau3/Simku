<?php

namespace Database\Seeders;

use App\Models\TahunSawit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunSawitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunSawit::factory(3)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\TransaksiInventaris;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiInventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransaksiInventaris::factory(50)->create();
    }
}

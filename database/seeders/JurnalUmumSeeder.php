<?php

namespace Database\Seeders;

use App\Models\JurnalUmum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurnalUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JurnalUmum::insert([
            [
                'tutup_buku_id' => 3,
                'total' => 50000000,
            ],
            [
                'tutup_buku_id' => 4,
                'total' => 5000000,
            ],
            [
                'tutup_buku_id' => 5,
                'total' => 15000000,
            ],
        ]);
    }
}

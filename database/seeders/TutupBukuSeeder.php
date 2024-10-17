<?php

namespace Database\Seeders;

use App\Models\TutupBuku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TutupBukuSeeder extends Seeder
{
    /**
     * Run the database seeds. date('Y_m_d')
     */
    public function run(): void
    {
        // TutupBuku::factory(5)->create();
        TutupBuku::insert([
            [
                'awal' => '2017-01-01',
                'akhir' => null,
            ],
        ]);
    }
}

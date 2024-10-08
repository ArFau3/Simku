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
                'awal' => '2023-01-01',
                'akhir' => '2023-03-01',
                'nominal' => 1000000,
            ],
            [
                'awal' => '2023-03-02',
                'akhir' => '2023-06-01',
                'nominal' => 300000,
            ],
            [
                'awal' => '2023-07-01',
                'akhir' => '2023-011-01',
                'nominal' => 1200000,
            ],
            [
                'awal' => '2023-11-02',
                'akhir' => '2023-11-05',
                'nominal' => 5000000,
            ],
            [
                'awal' => '2023-12-01',
                'akhir' => null,
                'nominal' => 0,
            ],
        ]);
    }
}

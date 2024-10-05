<?php

namespace Database\Seeders;

use App\Models\TBS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TBSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TBS::insert(
            [
                'rekening' => 16,
            ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemasukan = Jenis::create([
            'jenis' => 'Pemasukan',
        ]);

        $pengeluaran = Jenis::create([
            'jenis' => 'Pengeluaran',
        ]);

        $hutang = Jenis::create([
            'jenis' => 'Hutang',
        ]);

        $piutang = Jenis::create([
            'jenis' => 'Piutang',
        ]);

        $penyusutan = Jenis::create([
            'jenis' => 'Penyusutan',
        ]);

        $tanam_modal = Jenis::create([
            'jenis' => 'Tanam Modal',
        ]);

        $tarik_modal = Jenis::create([
            'jenis' => 'Tarik Modal',
        ]);

        $lainnya = Jenis::create([
            'jenis' => 'Lainnya',
        ]);
    }
}

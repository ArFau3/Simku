<?php

namespace Database\Seeders;

use App\Models\Rekening;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 5 REKENING UTAMA
        Rekening::insert([
        [
            'nama' => 'Aset',
            'edit' => false,
            'nomor' => '1',
        ],[
            'nama' => 'Kewajiban',
            'edit' => false,
            'nomor' => '2',
        ],[
            'nama' => 'Ekuitas',
            'edit' => false,
            'nomor' => '3',
        ],[
            'nama' => 'Pendapatan',
            'edit' => false,
            'nomor' => '4',
        ],[
            'nama' => 'Beban',
            'edit' => false,
            'nomor' => '5',
        ]
        ]);
    // REKENING TERKUNCI LAINNYA
    Rekening::insert([
        [
            'nama' => 'Aset Lancar',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.1',
        ],[
            'nama' => 'Kas',
            'edit' => false,
            'rekening_induk' => 6,
            'nomor' => '1.1.1',
        ],[
            'nama' => 'Aset Tetap',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.2',
        ],[
            'nama' => 'Peralatan Kantor',
            'edit' => false,
            'rekening_induk' => 8,
            'nomor' => '1.2.1',
        ],[
            'nama' => 'Penyusutan Kas',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.3',
        ],[
            'nama' => 'Laba Rugi Tahun Berjalan',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.1',
        ],[
            'nama' => 'Laba Rugi Ditahan',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.2',
        ],[
            'nama' => 'Modal Awal',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.3',
        ],[
            'nama' => 'Penambahan Modal',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.4',
        ],[
            'nama' => 'Modal Saham',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.5',
        ],[
            'nama' => 'Pendapatan Penjualan TBS',
            'edit' => false,
            'rekening_induk' => 4,
            'nomor' => '4.1',
        ],[
            'nama' => 'Biaya Operasional',
            'edit' => false,
            'rekening_induk' => 5,
            'nomor' => '5.1',
        ],
        ]);
        Rekening::factory(20)->create();
    }
}

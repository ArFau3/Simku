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
            "desimal" => 1000000,
        ],[
            'nama' => 'Kewajiban',
            'edit' => false,
            'nomor' => '2',
            "desimal" => 2000000,
        ],[
            'nama' => 'Ekuitas',
            'edit' => false,
            'nomor' => '3',
            "desimal" => 3000000,
        ],[
            'nama' => 'Pendapatan',
            'edit' => false,
            'nomor' => '4',
            "desimal" => 4000000,
        ],[
            'nama' => 'Beban',
            'edit' => false,
            'nomor' => '5',
            "desimal" => 5000000,
        ]
        ]);
    // REKENING TERKUNCI LAINNYA
    Rekening::insert([
        [
            'nama' => 'Aset Lancar',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.1',
            "desimal" => 1010000,
        ],[
            'nama' => 'Kas',
            'edit' => false,
            'rekening_induk' => 6,
            'nomor' => '1.1.1',
            "desimal" => 1010100,
        ],[
            'nama' => 'Aset Tetap',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.2',
            "desimal" => 1020000,
        ],[
            'nama' => 'Peralatan Kantor',
            'edit' => false,
            'rekening_induk' => 8,
            'nomor' => '1.2.1',
            "desimal" => 1020100,
        ],[
            'nama' => 'Penyusutan Kas',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.3',
            "desimal" => 1030000,
        ],[
            'nama' => 'Laba Rugi Tahun Berjalan',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.1',
            "desimal" => 3010000,
        ],[
            'nama' => 'Laba Rugi Ditahan',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.2',
            "desimal" => 3020000,
        ],[
            'nama' => 'Modal Awal',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.3',
            "desimal" => 3030000,
        ],[
            'nama' => 'Penambahan Modal',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.4',
            "desimal" => 3040000,
        ],[
            'nama' => 'Modal Saham',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.5',
            "desimal" => 3050000,
        ],[
            'nama' => 'Pendapatan Penjualan TBS',
            'edit' => false,
            'rekening_induk' => 4,
            'nomor' => '4.1',
            "desimal" => 4010000,
        ],[
            'nama' => 'Biaya Operasional',
            'edit' => false,
            'rekening_induk' => 5,
            'nomor' => '5.1',
            "desimal" => 5010000,
        ],[
            'nama' => 'Ikhtisar Laba/Rugi',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.6',
            "desimal" => 3060000,
        ],
        ]);
        Rekening::factory(13)->create();
    }
}

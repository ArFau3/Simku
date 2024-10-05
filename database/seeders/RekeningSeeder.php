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
            "desimal" => 10000,
        ],[
            'nama' => 'Kewajiban',
            'edit' => false,
            'nomor' => '2',
            "desimal" => 20000,
        ],[
            'nama' => 'Ekuitas',
            'edit' => false,
            'nomor' => '3',
            "desimal" => 30000,
        ],[
            'nama' => 'Pendapatan',
            'edit' => false,
            'nomor' => '4',
            "desimal" => 40000,
        ],[
            'nama' => 'Beban',
            'edit' => false,
            'nomor' => '5',
            "desimal" => 50000,
        ]
        ]);
    // REKENING TERKUNCI LAINNYA
    Rekening::insert([
        [
            'nama' => 'Aset Lancar',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.1',
            "desimal" => 10100,
        ],[
            'nama' => 'Kas',
            'edit' => false,
            'rekening_induk' => 6,
            'nomor' => '1.1.1',
            "desimal" => 10101,
        ],[
            'nama' => 'Aset Tetap',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.2',
            "desimal" => 10200,
        ],[
            'nama' => 'Peralatan Kantor',
            'edit' => false,
            'rekening_induk' => 8,
            'nomor' => '1.2.1',
            "desimal" => 10201,
        ],[
            'nama' => 'Penyusutan Kas',
            'edit' => false,
            'rekening_induk' => 1,
            'nomor' => '1.3',
            "desimal" => 10300,
        ],[
            'nama' => 'Laba Rugi Tahun Berjalan',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.1',
            "desimal" => 30100,
        ],[
            'nama' => 'Laba Rugi Ditahan',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.2',
            "desimal" => 30200,
        ],[
            'nama' => 'Modal Awal',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.3',
            "desimal" => 30300,
        ],[
            'nama' => 'Penambahan Modal',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.4',
            "desimal" => 30400,
        ],[
            'nama' => 'Modal Saham',
            'edit' => false,
            'rekening_induk' => 3,
            'nomor' => '3.5',
            "desimal" => 30500,
        ],[
            'nama' => 'Pendapatan Penjualan TBS',
            'edit' => false,
            'rekening_induk' => 4,
            'nomor' => '4.1',
            "desimal" => 40100,
        ],[
            'nama' => 'Biaya Operasional',
            'edit' => false,
            'rekening_induk' => 5,
            'nomor' => '5.1',
            "desimal" => 50100,
        ],
        ]);
        Rekening::factory(20)->create();
    }
}

<?php

namespace App\Charts;

use App\Models\Transaksi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class testChart2
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function setTable($bulan){
        $tahun = \Carbon\Carbon::now()->year;
        // jika tampilkan dalam bulan, hanya tahun tersebut terakhir
        if($bulan){
        // filter data
        $dataDirty = Transaksi::where('kredit', 7)->orderBy('tanggal')->filter($tahun.'-01-01',$tahun.'-12-31')->get();
        
        // siapin array chart
        $data = array();
        // looping per bulan
        for($i=1;$i<13;$i++){
            // reset nominal
            $nominal = 0;

            if($i<10){
                $nominal = $dataDirty->where('tanggal', '>=', $tahun . '-0' . $i . '-01')
                ->where('tanggal', '<=', $tahun . '-0' . $i . '-31')
                ->sum('nominal');
            }else{
                $nominal = $dataDirty->where('tanggal', '>=', $tahun . '-' . $i . '-01')
                ->where('tanggal', '<=', $tahun . '-' . $i . '-31')
                ->sum('nominal');
            }

            // masukkan data per bulan
            $data[] = $nominal;
        }
        // buat grafik
        return $this->build($data, $bulan);

        // jika pakai tampilkan per tahun, 5 tahun terakhir
        }else{
            // filter data
        $dataDirty = Transaksi::where('debit', 7)->orderBy('tanggal')->filter(($tahun-4).'-01-01',$tahun.'-12-31')->get();
        // siapin array chart
        $data = array();

        // looping pertahun
        for($i=$tahun-4; $i<=$tahun;$i++){
            // reset nominal
            $nominal = 0;

            $nominal = $dataDirty->where('tanggal', '>=', $i . '-01-01')
                ->where('tanggal', '<=', $i . '-' . $i . '-12-31')
                ->sum('nominal');

            // masukkan data per tahun
            $data[] = $nominal;
        }

        // buat grafik
        return $this->build($data, $bulan);
        }
        
    }

    public function build($data, $bulan): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // Jika Per Bulan
        if($bulan){
            return $this->chart->barChart()
            ->setTitle('Kas Keluar')
            ->setSubtitle('Wins during season 2021.')
            ->addData("Kas Keluar",$data)
            ->setXAxis(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']);
        
            // Jika Per Tahun
        }else{   
        $tahun = \Carbon\Carbon::now()->year;

            return $this->chart->barChart()
            ->setTitle('Kas Keluar')
            ->setSubtitle('Wins during season 2021.')
            ->addData("Kas Keluar",$data)
            ->setXAxis([$tahun-4,$tahun-3,$tahun-2,$tahun-1,$tahun]);
        }
            
    }
}

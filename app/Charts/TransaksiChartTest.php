<?php

namespace App\Charts;

use App\Models\TransaksiInventaris;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransaksiChartTest
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function setTable(){
        $dataDirty = TransaksiInventaris::where('debit', 7)->select('nominal')->get();
        // dd($dataDirty);
        $data = array();
        foreach($dataDirty as $dataPush){
            $data[] = $dataPush['nominal'];
        }
        return $this->build($data);
    }

    public function build($data): \ArielMejiaDev\LarapexCharts\BarChart
    {

        return $this->chart->barChart()
            ->setTitle('San Francisco vs Boston.')
            ->setSubtitle('Wins during season 2021.')
            ->addData("Kas",$data)
            ->setXAxis(['January']);

            // ->addData('San Francisco', [6, 9, 3, 4, 10, 8])
            // ->addData('Boston', [7, 3, 8, 2, 6, 4])
            // ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
            
    }
}

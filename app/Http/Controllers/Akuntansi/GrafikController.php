<?php

namespace App\Http\Controllers\Akuntansi;

use App\Charts\TransaksiChartTest;
use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;

class GrafikController extends Controller
{
    public function index(TransaksiChartTest $chart, Request $request)
{
    $data = [
        "title" => "Grafik",
        'user' => $request->user(),
        'judul' => 'Coba Lib Grafik',
        'chart' => $chart->build(),
    ];
    return view('akuntansi.grafik.index', $data);
}
}

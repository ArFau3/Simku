<?php

namespace App\Http\Controllers\Akuntansi;

use App\Charts\testChart2;
use App\Charts\TransaksiChartTest;
use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;

class GrafikController extends Controller
{
    public function index(TransaksiChartTest $kas_masuk, testChart2 $kas_keluar, Request $request)
{
        $kas_m = $kas_masuk->setTable($request["bulan"]);
        $kas_k = $kas_keluar->setTable($request["bulan"]);
    
    $data = [
        "title" => "Grafik",
        'user' => $request->user(),
        'judul' => 'Coba Lib Grafik',
        'kas_masuk' => $kas_m,
        'kas_keluar' => $kas_k,
    ];
    return view('akuntansi.grafik.index', $data);
}
}

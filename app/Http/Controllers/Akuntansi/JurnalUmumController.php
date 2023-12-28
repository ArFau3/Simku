<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\JurnalUmum;
use App\Models\TransaksiInventaris;
use App\Models\TutupBuku;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    public function index(Request $request)
    {
        $periode = TutupBuku::all();
        $data = [
            "title" => "Jurnal Umum",
            'user' => $request->user(),
            'judul' => 'Jurnal Umum',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->get(),
            'ju' => $periode->whereNull('akhir'),
        ];
        return view('akuntansi.ju.index', $data);
    }
}

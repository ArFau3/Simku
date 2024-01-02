<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use Illuminate\Http\Request;

class NeracaController extends Controller
{
    public function index(Request $request){
        $data = [
            "title" => "Neraca",
            'user' => $request->user(),
            'aset' => Rekening::where('nomor', 'like',  1 . '%')->get(),
            'kewajiban' => Rekening::where('nomor', 'like',  2 . '%')->get(),
            'modal' => Rekening::where('nomor', 'like',  3 . '%')->get(),
            'judul' => 'Neraca',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->get(),
        ];
        return view('akuntansi.neraca.index', $data);
    } 
}

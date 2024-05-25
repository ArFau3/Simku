<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function index(Request $request){
        $data = [
            "title" => "Buku Besar",
            'user' => $request->user(),
            'rekening' => Rekening::orderBy('nomor')->get(),
            'judul' => 'Buku Besar',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
        ];
        return view('akuntansi.buku_besar.index', $data);
    }
}

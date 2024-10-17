<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PerubahanModalController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "title" => "Perubahan Modal",
            'user' => $request->user(),
            'judul' => 'Perubahan Modal',
            'transaksi' => Transaksi::orderBy('tanggal')->inventaris('3')->cari($request['cari'])->filter($request['awal'],
                                                                                                                    $request['akhir']
                                                                                                            )->get(),
            
        ];
        return view('akuntansi.perubahan_modal.index', $data);
    }
    // TODO: download dan ArusKasController
}

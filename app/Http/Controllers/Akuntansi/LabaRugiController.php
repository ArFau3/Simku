<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    public function index(Request $request){
        $data = [
            "title" => "Laba Rugi",
            'user' => $request->user(),
            'rekening' => Rekening::where('nomor', 'like',  4 . '%')
                                    ->orWhere('nomor', 'like',  5 . '%')
                                    ->get(),
            'judul' => 'Laba Rugi',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->get(),
        ];
        return view('akuntansi.laba_rugi.index', $data);
    }
}

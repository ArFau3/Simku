<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Rekening;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index(Request $request){
        $data = [
            "title" => "Aktivitas",
            'user' => $request->user(),
            'judul' => 'Aktivitas',
            // FIXME: sistem cari/filter
            'aktivitas' => Aktivitas::orderBy('created_at')->paginate(30),
        ];
        return view('akuntansi.aktivitas.aktivitas', $data);
    }

    public function historyRekening(Aktivitas $id, Request $request){
        $data = [
            "title" => "Aktivitas",
            'user' => $request->user(),
            'judul' => 'Riwayat Rekening',
            'old_rekening' => $id->oldRekening,
            'current_rekening' => $id->currentRekening,
        ];
        return view('akuntansi.aktivitas.editedRekening', $data);
    }

    public function historyTransaksi(Aktivitas $id, Request $request){
        $data = [
            "title" => "Aktivitas",
            'user' => $request->user(),
            'judul' => 'Riwayat Transaksi',
            'old_transaksi' => $id->oldTransaksi,
            'current_transaksi' => $id->currentTransaksi,
        ];
        return view('akuntansi.aktivitas.editedTransaksi', $data);
    }
}

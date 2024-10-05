<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Rekening;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    #region test
    public function index(Request $request){
        $data = [
            "title" => "Aktivitas",
            'user' => $request->user(),
            'judul' => 'Aktivitas',
            'aktivitas' => Aktivitas::orderBy('created_at')->cari($request['cari'])->filter($request['awal'],
                                                                                    $request['akhir'])->paginate(30),
        ];
        return view('akuntansi.aktivitas.aktivitas', $data);
        #endregion
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

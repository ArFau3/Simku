<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use App\Models\TutupBuku;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    public function index(Request $request){
        $taggalTutupBukuTerakhir = TutupBuku::where("akhir",  null)->get()[0]["awal"];
        if(!$request['awal']){
            $request['awal'] = $taggalTutupBukuTerakhir;
            $request['akhir'] = \Carbon\Carbon::now()->toDateString();
        }

        $data = [
            "title" => "Laba Rugi",
            'user' => $request->user(),
            'pendapatan' => Rekening::where('nomor', 'like',  4 . '%')->get(),
            'beban' => Rekening::where('nomor', 'like',  5 . '%')->get(),
            'judul' => 'Laba Rugi',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->filter($request['awal'],
                                                                        $request['akhir']
                                                                    )->get(),
            'tutup_buku' => $taggalTutupBukuTerakhir,
        ];
        return view('akuntansi.laba_rugi.index', $data);
    }

    public function download(Request $request)
    {
        // FIXME: perbaiki tanggal per ?
        $data = [
            "title" => "Laba Rugi",
            'user' => $request->user(),
            'pendapatan' => Rekening::where('nomor', 'like',  4 . '%')->get(),
            'beban' => Rekening::where('nomor', 'like',  5 . '%')->get(),
            'judul' => 'Laba Rugi',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->filter($request['awal'],
                                                                        $request['akhir']
                                                                    )->get(),
        ];
        $pdf = Pdf::loadView('akuntansi.laba_rugi.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Laba Rugi.pdf');
    }
}

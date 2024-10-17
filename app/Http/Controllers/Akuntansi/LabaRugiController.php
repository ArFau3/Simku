<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\Transaksi;
use App\Models\TutupBuku;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LabaRugiController extends Controller
{
    public function index(Request $request){
        $taggalTutupBukuTerakhir = TutupBuku::where("akhir",  null)->get()[0]["awal"];
        if($request['periode']){
            $request['awal'] = $request['periode']."-01-01";
        }elseif(!$request['awal'] && !$request['periode']){
            $request['awal'] = $taggalTutupBukuTerakhir;
        }
        $request['akhir'] = Carbon::now()->toDateString();
// TODO: proses laba rugi sebelum dan sesuadh pajak
        $data = [
            "title" => "Laba Rugi",
            'user' => $request->user(),
            'pendapatan' => Rekening::where('nomor', 'like',  4 . '%')->get(),
            'beban' => Rekening::where('nomor', 'like',  5 . '%')->get(),
            'judul' => 'Laba Rugi',
            'transaksi' => Transaksi::orderBy('tanggal')->filter($request['awal'],
                                                                        $request['akhir']
                                                                    )->get(),
            'tutup_buku' => $taggalTutupBukuTerakhir,
            'year' => \Carbon\Carbon::now()->year,
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
            'transaksi' => Transaksi::orderBy('tanggal')->filter($request['awal'],
                                                                        $request['akhir']
                                                                    )->get(),
        ];
        $pdf = Pdf::loadView('akuntansi.laba_rugi.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Laba Rugi.pdf');
    }
}

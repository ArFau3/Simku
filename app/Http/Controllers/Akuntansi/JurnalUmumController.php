<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\JurnalUmum;
use App\Models\TransaksiInventaris;
use App\Models\TutupBuku;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    public function index(Request $request)
    {
        // FIXME: fungsi periode untuk ap ?
        $periode = TutupBuku::all();
        $data = [
            "title" => "Jurnal Umum",
            'user' => $request->user(),
            'judul' => 'Jurnal Umum',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
            'ju' => $periode->whereNull('akhir'),
        ];
        return view('akuntansi.ju.index', $data);
    }

    public function download(Request $request)
    {
        // FIXME: fungsi periode untuk ap ?
        $periode = TutupBuku::all();
        $data = [
            "title" => "Jurnal Umum",
            'user' => $request->user(),
            'judul' => 'Jurnal Umum',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
            'ju' => $periode->whereNull('akhir'),
        ];
        $pdf = Pdf::loadView('akuntansi.ju.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Jurnal Umum.pdf');
    }
}

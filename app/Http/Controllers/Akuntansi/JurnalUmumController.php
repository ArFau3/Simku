<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Koperasi;
use App\Models\Transaksi;
use App\Models\TutupBuku;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class JurnalUmumController extends Controller
{
    public function index(Request $request)
    { 
        if(!$request['awal']){
            $request['awal'] = $request->user()->koperasi->berdiri;
            $request['akhir'] = \Carbon\Carbon::now()->toDateString();;
        }
        
        $data = [
            "title" => "Jurnal Umum",
            'user' => $request->user(),
            'judul' => 'Jurnal Umum',
            'transaksis' => Transaksi::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->paginate(50),
        ];
        return view('akuntansi.ju.index', $data);
    }

    public function download(Request $request)
    {
        // FIXME: perbaiki tanggal per ?
        $periode = TutupBuku::all();
        $data = [
            "title" => "Jurnal Umum",
            'user' => $request->user(),
            'judul' => 'Jurnal Umum',
            'transaksi' => Transaksi::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
            'ju' => $periode->whereNull('akhir'),
        ];
        $pdf = Pdf::loadView('akuntansi.ju.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Jurnal Umum.pdf');
    }
}

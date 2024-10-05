<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use App\Models\TutupBuku;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NeracaController extends Controller
{
    public function index(Request $request){

        $tutpBukuTerakhir = TutupBuku::whereNotNull("akhir")->orderBy("akhir", "desc")->first();
        if ($tutpBukuTerakhir){
            $tutpBukuTerakhir = $tutpBukuTerakhir["akhir"];
        }else{
            $tutpBukuTerakhir = Carbon::now();
        }
        if(!$request['awal']){
            $request['awal'] = $request->user()->koperasi->berdiri;
            $request['akhir'] = $tutpBukuTerakhir;
        }
        
        $data = [
            "title" => "Neraca",
            'user' => $request->user(),
            'aset' => Rekening::where('nomor', 'like',  1 . '%')->get(),
            'kewajiban' => Rekening::where('nomor', 'like',  2 . '%')->get(),
            'modal' => Rekening::where('nomor', 'like',  3 . '%')->get(),
            'judul' => 'Neraca',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->filter($request['awal'],
                                                                            $request['akhir']
                                                                    )->get(),
            "tutup_buku" => $tutpBukuTerakhir,
        ];
        return view('akuntansi.neraca.index', $data);
    } 

    public function download(Request $request){
        // FIXME: perbaiki tanggal per ?
        $data = [
            "title" => "Neraca",
            'user' => $request->user(),
            'aset' => Rekening::where('nomor', 'like',  1 . '%')->get(),
            'kewajiban' => Rekening::where('nomor', 'like',  2 . '%')->get(),
            'modal' => Rekening::where('nomor', 'like',  3 . '%')->get(),
            'judul' => 'Neraca',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->filter($request['awal'],
                                                                            $request['akhir']
                                                                    )->get(),
        ];
        $pdf = Pdf::loadView('akuntansi.neraca.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Neraca.pdf');
    } 
}

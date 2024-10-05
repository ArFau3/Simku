<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TBS;
use App\Models\TransaksiInventaris;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TBSController extends Controller
{
    public function index(Request $request){

        $tahun = Carbon::now()->year;
        if (!$request['tahun']){
            $request['awal'] = $tahun."-01-01";
            $request['akhir'] = $tahun."-12-31";
            $request['tahun'] = $tahun;
        }else{
            $request['awal'] = $request['tahun']."-01-01";
            $request['akhir'] = $request['tahun']."-12-31";
        }

        $data = [
            "title" => "Penjualan TBS",
            'user' => $request->user(),
            'rekenings' => TBS::all(),
            'judul' => 'Penjualan TBS',
            'transaksis' => TransaksiInventaris::orderBy('tanggal')->filter($request['awal'],
                                                                            $request['akhir']
                                                                    )->get(),
            "tahun" => $tahun,
            "bulans" => ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
        ];
       
        return view('akuntansi.tbs.index', $data);
    }

    public function tautkanIndex(Request $request){
        $data = [
            "title" => "Penjualan TBS",
            'user' => $request->user(),
            'rekenings' => Rekening::all(),
            'rekening_tertaut' => TBS::all(),
            'judul' => 'Penjualan TBS',
        ];
        return view('akuntansi.tbs.tautkan', $data);
    }

    public function tautkan(Rekening $id, Request $request){
        // TODO: Validasi apakah rekening sudah tertaut atau belum
        // Insert New data
        $data = new TBS();
        $data->rekening = $id->id;

        $data->save();

        // redirect to /rekening
        return redirect('/penjualan-tbs');
    }

    public function delete(TBS $id){
        TBS::destroy($id->id);
        return redirect('/penjualan-tbs');
    }
}

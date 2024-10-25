<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function index(Request $request){
        $now = \Carbon\Carbon::now()->toDateString();
        if(!$request['awal']){
            $request['awal'] = $request->user()->koperasi->berdiri;
            $request['akhir'] = $now;
        }

        // setting rekening apakah ambil semua atau paginate
        if($request['cari']||$request['awal']){
            // HACK: jika di paginate ketika ada filter maka error karena paginate di rekening tapi filter di transaksi
            $rekening = Rekening::orderBy('desimal')->get();
        }else{
            $rekening = Rekening::orderBy('desimal')->paginate(10);
        }
        $data = [
            "title" => "Buku Besar",
            'user' => $request->user(),
            // HACK: sebaiknya tidak usah pakai pagination di buku besar, toh bukan termasuk laporan
            'rekening' => $rekening,
            'judul' => 'Buku Besar',
            'transaksi' => Transaksi::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
            'now' => $now,

            // ===================================================
            // 'debit' => $trans->except('kredit'),
            // 'kredit' => $trans->except('debit'),
            // 'transaksi' => ,
            // ===================================================
        ];
        // $data['transaksi']->paginate(5);
        return view('akuntansi.buku_besar.index', $data);

        // $users = DB::table('users')
        //     ->join('contacts', 'users.id', '=', 'contacts.user_id')
        //     ->join('orders', 'users.id', '=', 'orders.user_id')
        //     ->select('users.*', 'contacts.phone', 'orders.price')
        //     ->get();
    }
    public function download(Request $request)
    {
        $data = [
            "title" => "Buku Besar",
            'user' => $request->user(),
            'rekening' => Rekening::orderBy('nomor')->get(),
            // "logo" =>public_path('storage/' . $request->user()->koperasi->logo),
            'judul' => 'Buku Besar',
            'transaksi' => Transaksi::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
        ];
        $pdf = Pdf::loadView('akuntansi.buku_besar.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Buku Besar.pdf');
    }
}

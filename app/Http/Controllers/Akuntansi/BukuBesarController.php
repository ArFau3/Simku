<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BukuBesarController extends Controller
{
    public function index(Request $request){
        $request['akhir'] = \Carbon\Carbon::now()->toDateString();
        $data = [
            "title" => "Buku Besar",
            'user' => $request->user(),
            // HACK: sebaiknya tidak usah pakai pagination di buku besar, toh bukan termasuk laporan
            'rekening' => Rekening::orderBy('nomor')->paginate(10),
            'judul' => 'Buku Besar',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),

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
        // FIXME: fungsi periode untuk ap ?
        $data = [
            "title" => "Buku Besar",
            'user' => $request->user(),
            'rekening' => Rekening::orderBy('nomor')->get(),
            'judul' => 'Buku Besar',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
        ];
        $pdf = Pdf::loadView('akuntansi.buku_besar.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Buku Besar.pdf');
    }
}

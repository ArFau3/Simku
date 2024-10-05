<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use App\Models\TutupBuku;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TutupBukuController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "title" => "Tutup Buku",
            'user' => $request->user(),
            'judul' => 'Daftar Tutup Buku',
            'tbs' => TutupBuku::orderBy('akhir', 'desc')->paginate(30),
        ];
        return view('akuntansi.tutup_buku.index', $data);
    }

    public function pilihTanggal(Request $request){
        $tanggal_awal = TutupBuku::where("akhir",  null)->get()[0]["awal"];
        if(!$request['awal']){
            $request['awal'] = $tanggal_awal;
            $request['akhir'] = \Carbon\Carbon::now()->toDateString();
        }

        $data = [
            "title" => "Tutup Buku",
            'user' => $request->user(),
            "tanggal_awal" => $tanggal_awal,
            'judul' => 'Masukkan Periode Tutup Buku',
        ];
        return view('akuntansi.tutup_buku.pilihTanggal', $data);
    }

    public function tambah(Request $request){
        // FIXME: cek input tanggal besok
        // FIXME: pastikan tanggal yang udah dalam rentang lama tidak bisa dipilih
        // dd($request);
        $data = [
            "title" => "Tutup Buku",
            'user' => $request->user(),
            'rekenings' => Rekening::where('nomor', 'like',  4 . '%')->orWhere('nomor', 'like',  5 . '%')->get(),
            'judul' => 'Lakukan Tutup Buku',
            'transaksis' => TransaksiInventaris::orderBy('tanggal')->filter($request['awal'],
                                                                            $request['akhir']
                                                                    )->get(),
        ];
        return view('akuntansi.tutup_buku.lakukan', $data);
    }

    public function store(Request $request){
        // dd($request->nominal);

        // Cari tutup buku terakhir
        $tutup_buku_terakhir = TutupBuku::where("akhir",  null)->get()[0];
        // edit data sesuai tutup buku yang baru dilakukan
        $tutup_buku_terakhir->awal = $request->awal;
        $tutup_buku_terakhir->akhir = $request->akhir;
        $tutup_buku_terakhir->nominal = $request->nominal * -1;
        $tutup_buku_terakhir->save();
        // edit data rekening laba rugi di modal agar neraca seimbang

        // FIXME: bagaimana dengan rekening laba rugi ditahan?
        $transaksi = new TransaksiInventaris();
        // FIXME: debit pakai rekening apa ya?
        $transaksi->debit = 10000;
        $transaksi->kredit = 11;
        $transaksi->jenis = 8;
        $transaksi->tanggal = $request->akhir;
        $transaksi->keterangan = "Tutup Buku Periode ". \Carbon\Carbon::parse($request->awal)->format('d M Y')." s/d ".
         \Carbon\Carbon::parse($request->akhir)->format('d M Y');
        $transaksi->nominal = $request->nominal * -1;
        $transaksi->save();
        // TODO: buat aktivitas
        // buat tutup buku periode baru
        $tutup_buku_baru = new TutupBuku();
        $tanggal_awal = Carbon::createFromFormat('Y-m-d', $request->akhir);
        $tutup_buku_baru->awal = $tanggal_awal->addDays(1);
        $tutup_buku_baru->nominal = 0;
        $tutup_buku_baru->save();
        return redirect('/tutup-buku');
    }

    public function delete(Request $request, TutupBuku $id){
        // hapus tutup buku terakhir yang TIDAK PUNYA tanggal akhir
        $tutup_buku_terakhir = TutupBuku::where("akhir",  null)->get()[0];
        TutupBuku::destroy($tutup_buku_terakhir->id);

        // Perbaiki nominal di rekening laba rugi modal 
        $transaksi = TransaksiInventaris::where("kredit", 11)->where("tanggal", $id->akhir)->where("nominal", $id->nominal)->first();
        TransaksiInventaris::destroy($transaksi->id);
        // TODO: buat aktivitas
        // FIXME: bagaimana dengan rekening laba rugi ditahan?

        // edit $id/tutup buku terakhir yang PUNYA tanggal akhir
        $id->akhir = null;
        $id->nominal = 0;
        $id->save();

        return redirect('/tutup-buku');
    }
}

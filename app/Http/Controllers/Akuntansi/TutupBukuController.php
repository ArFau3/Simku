<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\Transaksi;
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
            'pendapatan' => Rekening::where('nomor', 'like',  4 . '%')->orderBy('desimal')->get(),
            'beban' => Rekening::where('nomor', 'like',  5 . '%')->orderBy('desimal')->get(),
            'judul' => 'Lakukan Tutup Buku',
            'transaksis' => Transaksi::orderBy('tanggal')->filter($request['awal'],
                                                                            $request['akhir']
                                                                    )->get(),
        ];
        return view('akuntansi.tutup_buku.lakukan', $data);
    }

    public function store(Request $request){
        // konfigurasi nilai nominal
        $nominal = $request->nominal;
        // edit data rekening laba rugi di modal agar neraca seimbang
        if($nominal >= 0){
            $transaksi = Transaksi::create([
                // HACK: hardcode rekening by id, 11 = laba rugi tahun berjalan, 12 laba rugi ditahan, 18 = ikhtisar laba/rugi
                "debit" => 18,
                "kredit" => 11,
                "jenis" => 8,
                "tanggal" => $request->akhir,
                "keterangan" => "Tutup Buku Periode ". \Carbon\Carbon::parse($request->awal)->format('d M Y')." s/d ".
                 \Carbon\Carbon::parse($request->akhir)->format('d M Y'),
                "nominal" => $nominal,
                ])->id;
        }else{
            $transaksi = Transaksi::create([
                // HACK: hardcode rekening by id, 11 = laba rugi tahun berjalan, 12 laba rugi ditahan, 18 = ikhtisar laba/rugi
                "debit" => 11,
                "kredit" => 18,
                "jenis" => 8,
                "tanggal" => $request->akhir,
                "keterangan" => "Tutup Buku Periode ". \Carbon\Carbon::parse($request->awal)->format('d M Y')." s/d ".
                 \Carbon\Carbon::parse($request->akhir)->format('d M Y'),
                "nominal" => $nominal *-1,
                ])->id;
        }
        // TODO: buat aktivitas

         // Cari tutup buku terakhir
         $tutup_buku_terakhir = TutupBuku::where("akhir",  null)->get()[0];
         // edit data sesuai tutup buku yang baru dilakukan
         $tutup_buku_terakhir->awal = $request->awal;
         $tutup_buku_terakhir->akhir = $request->akhir;
         $tutup_buku_terakhir->transaksi_id = $transaksi;
         $tutup_buku_terakhir->save();

        // buat tutup buku periode baru
        $tutup_buku_baru = new TutupBuku();
        $tanggal_awal = Carbon::createFromFormat('Y-m-d', $request->akhir);
        $tutup_buku_baru->awal = $tanggal_awal->addDays(1);
        $tutup_buku_baru->save();
        return redirect('/tutup-buku');
    }

    public function delete(Request $request, TutupBuku $id){
        // hapus tutup buku terakhir yang TIDAK PUNYA tanggal akhir
        $tutup_buku_terakhir = TutupBuku::where("akhir",  null)->get()[0];
        TutupBuku::destroy($tutup_buku_terakhir->id);

        // Tampung id transaksi sebelum dijadikan null
        $transaksi = $id->transaksi_id;

        // edit $id/tutup buku terakhir yang PUNYA tanggal akhir
        $id->akhir = null;
        $id->transaksi_id = null;
        $id->save();

        // Perbaiki nominal di rekening laba rugi modal 
        Transaksi::destroy($transaksi);
        // TODO: buat aktivitas

        return redirect('/tutup-buku');
    }
    // TODO: download & rincian
}

<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Jenis;
use App\Models\OldTransaksi;
use App\Models\Rekening;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Number;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class TransaksiInventarisController extends Controller
{
    public function indexTransaksi(Request $request)
    {
        if(!$request['awal']){
            $request['awal'] = $request->user()->koperasi->berdiri;
            $request['akhir'] = \Carbon\Carbon::now()->toDateString();;
        }
        
        $data = [
            "title" => "Transaksi",
            'user' => $request->user(),
            'judul' => 'Daftar Transaksi',
            'transaksi' => Transaksi::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->paginate(25),
        ];
        // dd($data['transaksi']->where('tanggal', '<', $request['awal']));
        return view('akuntansi.transaksi_inventaris.index', $data);
    }

    public function indexInventaris(Request $request)
    {
        if(!$request['awal']){
            $request['awal'] = $request->user()->koperasi->berdiri;
            $request['akhir'] = \Carbon\Carbon::now()->toDateString();
        }
        $data = [
            "title" => "Aset Tetap",
            'user' => $request->user(),
            'judul' => 'Daftar Aset Tetap',
            'transaksi' => Transaksi::orderBy('tanggal')->inventaris('1.2')->cari($request['cari'])->filter($request['awal'],
                                                                                                                    $request['akhir']
                                                                                                            )->paginate(25),
            
        ];
        return view('akuntansi.transaksi_inventaris.index', $data);
    }

    public function downloadTransaksi(Request $request){
        if(!$request['awal']){
            $request['awal'] = $request->user()->koperasi->berdiri;
            $request['akhir'] = \Carbon\Carbon::now()->toDateString();;
        }

        $data = [
            'user' => $request->user(),
            'title' => "Histori Transaksi",
            'judul' => 'Daftar Transaksi',
            'transaksi' => Transaksi::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
        ];
// FIXME: tambahkan tanggal dalam judul pdf
        $pdf = Pdf::loadView('akuntansi.transaksi_inventaris.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Histori Transaksi.pdf');

        // return view('akuntansi.transaksi_inventaris.download', $data);
    }
    public function downloadInventaris(Request $request)
    {
        if(!$request['awal']){
            $request['awal'] = $request->user()->koperasi->berdiri;
            $request['akhir'] = \Carbon\Carbon::now()->toDateString();;
        }
        
        $data = [
            "title" => "Aset Tetap",
            'user' => $request->user(),
            'judul' => 'Daftar Aset Tetap',
            'transaksi' => Transaksi::orderBy('tanggal')->inventaris('1.2')->cari($request['cari'])->filter($request['awal'],
                                                                                                                    $request['akhir']
                                                                                                            )->get(),
            
        ];
        $pdf = Pdf::loadView('akuntansi.transaksi_inventaris.download', $data);
        $pdf->setPaper("A4", "potrait");
        return $pdf->stream('Histori Inventaris.pdf');
    }

    public function edit(Transaksi $id, Request $request)
    {
        $data = [
            "title" => "Transaksi",
            'user' => $request->user(),
            'judul' => 'Edit Transaksi',
            'rekening' => Rekening::orderBy('nomor')->get(),
            'jenis' => Jenis::all(),
            'transaksi' => $id,
        ];
            return view('akuntansi.transaksi_inventaris.update', $data);
    }

    public function update(Request $request, Transaksi $id){
        // Rule Validation
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required', 'date',
            'debit' => 'required',
            'jenis' => 'required',
            'kredit' => 'required',
            'keterangan' => 'required',
            'nominal' => 'required'
        ]);

        // Validating input
        $validated = $validator->validated();

        // Nominal collumn handler
        // menghapus 3 karakter belakang (,00)
        $strip = Str::remove(',00', $validated['nominal']);
        // menghapus karakter non angka
        $transform = preg_replace('/[^0-9]/', '', $strip);
        // Merubah kolom nominal menjadi float
        $nominal = (float)$transform;

        // Merubah kolom jenis, debit & kredit menjadi int
        $jenis = (int)$validated['jenis'];
        $debit = (int)$validated['debit'];
        $kredit = (int)$validated['kredit'];

        // Siapkan data history
        // QOL: saat di rincian aktivitas, ada 1-click button to rollback data
        // replicate data to oldRekening
        $replicated_data = OldTransaksi::create([
            'debit' => $id->rekeningDebit->nama,
            'kredit' => $id->rekeningKredit->nama,
            'jenis' => $id->jenisTransaksi->jenis,
            'tanggal' => $id->tanggal,
            'keterangan' => $id->keterangan,
            'nominal' => $id->nominal,
        ]);

        // insert data aktivitas
        $aktivitas = new Aktivitas();
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap.
                    " <b>merubah</b> transaksi <b>".$id->rekeningDebit->nama. 
                    " - ".$id->rekeningKredit->nama.
                    "</b> dari Tanggal <b>".$id->tanggal."</b>";
        $aktivitas->deskripsi = ucfirst($rincian);
        // reference
        $aktivitas->old_transaksi = $replicated_data->id;
        $aktivitas->current_transaksi = $id->id;
        // save aktivitas
        $aktivitas->save();

        // Update database
        $id->debit = $debit;
        $id->kredit = $kredit;
        $id->jenis = $jenis;
        $id->tanggal = $validated['tanggal'];
        $id->keterangan = $validated['keterangan'];
        $id->nominal = $nominal;
        
        $id->save();

        // redirect to /transaksi
        return redirect('/transaksi');
    }

    public function tambah(Request $request)
    {
        $data = [
            "title" => "Transaksi",
            'user' => $request->user(),
            'judul' => 'Tambah Transaksi',
            'transaksi' => Transaksi::all()->sortBy('tanggal'),
            'jenis' => Jenis::all(),
            'rekening' => Rekening::orderBy('nomor')->get(),
        ];
        return view('akuntansi.transaksi_inventaris.create', $data);
    }

    public function store(Request $request){
        // Rule Validation
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required', 'date',
            'debit' => 'required',
            'jenis' => 'required',
            'kredit' => 'required',
            'keterangan' => 'required',
            'nominal' => 'required'
        ]);

        // Validating input
        $validated = $validator->validated();

        // Nominal collumn handler
        // menghapus 3 karakter belakang (,00)
        $strip = Str::remove(',00', $validated['nominal']);
        // menghapus karakter non angka
        $transform = preg_replace('/[^0-9]/', '', $strip);
        // Merubah kolom nominal menjadi float
        $nominal = (float)$transform;

        // Merubah kolom jenis, debit & kredit menjadi int
        $jenis = (int)$validated['jenis'];
        $debit = (int)$validated['debit'];
        $kredit = (int)$validated['kredit'];

        // Insert data aktivitas
        $aktivitas = new Aktivitas();
        // HACK: dapat data debit-kredit dari data yg blm disimpan
        $nama_debit = Rekening::where("id", $debit)->get()[0]['nama'];
        $nama_kredit = Rekening::where("id", $kredit)->get()[0]['nama'];
        // masukkan history
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap.
                    " <b>menambahkan</b> transaksi <b>".$nama_debit." - ".$nama_kredit.
                    "</b> ".Number::currency($nominal, 'IDR', 'id');
        $aktivitas->deskripsi = ucfirst($rincian);
        $aktivitas->save();

        // Insert New data
        $data = new Transaksi();
        $data->debit = $debit;
        $data->kredit = $kredit;
        $data->jenis = $jenis;
        $data->tanggal = $validated['tanggal'];
        $data->keterangan = $validated['keterangan'];
        $data->nominal = $nominal;

        $data->save();

        // redirect to /rekening
        return redirect('/transaksi');
    }

    public function delete(Transaksi $id, Request $request){
        // Insert data aktivitas
        $aktivitas = new Aktivitas();
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap.
                    " <b>menghapus</b> transaksi <b>".$id->rekeningDebit->nama. 
                    " - ".$id->rekeningKredit->nama.
                    "</b> dari tanggal <b>".$id->tanggal."</b>";
        $aktivitas->deskripsi = $rincian;
        $aktivitas->save();

        Transaksi::destroy($id->id);
        return redirect('/transaksi');
    }
}

<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Jenis;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransaksiInventarisController extends Controller
{
    public function indexTransaksi(Request $request)
    {
        $data = [
            "title" => "Transaksi",
            'user' => $request->user(),
            'judul' => 'Daftar Transaksi',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->cari($request['cari'])->filter($request['awal'],
                                                                                                    $request['akhir']
                                                                                            )->get(),
        ];
        // dd($data['transaksi']->where('tanggal', '<', $request['awal']));
        return view('akuntansi.transaksi_inventaris.index', $data);
    }

    public function indexInventaris(Request $request)
    {
        $data = [
            "title" => "Aset Tetap",
            'user' => $request->user(),
            'judul' => 'Daftar Aset Tetap',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->inventaris('1.2')->cari($request['cari'])->filter($request['awal'],
                                                                                                                    $request['akhir']
                                                                                                            )->get(),
            
        ];
        return view('akuntansi.transaksi_inventaris.index', $data);
    }

    public function edit(TransaksiInventaris $id, Request $request)
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

    public function update(Request $request, TransaksiInventaris $id){
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
        $strip = substr($request['nominal'], 0, -3);
        // menghapus karakter non angka
        $transform = preg_replace('/[^0-9]/', '', $strip);
        // Merubah kolom nominal menjadi float
        $nominal = (float)$transform;

        // Merubah kolom jenis, debit & kredit menjadi int
        $jenis = (int)$validated['jenis'];
        $debit = (int)$validated['debit'];
        $kredit = (int)$validated['kredit'];

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
            'transaksi' => TransaksiInventaris::all()->sortBy('tanggal'),
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
        $strip = substr($request['nominal'], 0, -3);
        // menghapus karakter non angka
        $transform = preg_replace('/[^0-9]/', '', $strip);
        // Merubah kolom nominal menjadi float
        $nominal = (float)$transform;

        // Merubah kolom jenis, debit & kredit menjadi int
        $jenis = (int)$validated['jenis'];
        $debit = (int)$validated['debit'];
        $kredit = (int)$validated['kredit'];

        // Insert New data
        $data = new TransaksiInventaris();
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

    public function delete(TransaksiInventaris $id){
        TransaksiInventaris::destroy($id->id);
        return redirect('/transaksi');
    }
}

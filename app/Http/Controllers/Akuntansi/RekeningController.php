<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RekeningController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Daftar Rekening',
            'rekening' => Rekening::orderBy('nomor')->cari($request['cari'])->get(),
            'rekening_json' => Rekening::all(),
        ];
        return view('akuntansi.rekening.index', $data);
    }


    public function edit(Rekening $id, Request $request)
    {
        if($id['edit'] == 1){
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Edit Rekening',
            'rekenings' => Rekening::orderBy('nomor')->get(),
            'rekening' => $id,
            'rekening_json' => Rekening::select('id as rekening_id','nomor')->orderBy('nomor')->get(),
        ];
            return view('akuntansi.rekening.update', $data);
        }else{
            return redirect('/rekening');
        }
    }

    public function update(Rekening $id, Request $request){
        // Rule Validation
        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                Rule::unique('rekenings','nama')->ignore($request->id),
                'max:100',
            ],
            'induk' => 'required',
            'nomor' => 'required',
        ]);

        // Validating input
        $validated = $validator->validated();

        // Merubah kolom induk menjadi int
        $induk = (int)$validated['induk'];

        // Insert data aktivitas
        // QOL: edit rekening hanya menampilkan data nomor+nama lama -> baru, tidak ada penjelas mana data yg berubah 
        $aktivitas = new Aktivitas();
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap." <b>merubah</b> rekening <b>".$id->nomor." ".$id->nama. "</b> menjadi <b>".$validated['nomor']." ".$validated['nama']."</b>";
        $aktivitas->deskripsi = $rincian;
        $aktivitas->save();

        // Update database
        $id->nama = $validated['nama'];
        $id->nomor = $validated['nomor'];
        $id->rekening_induk = $induk;

        $id->save();

        // redirect to /rekening
        return redirect('/rekening');
    }

    public function tambah(Request $request)
    {
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Tambah Rekening',
            'rekening' => Rekening::orderBy('nomor')->get(),
            'last' =>Rekening::all()->last(),
            'rekening_json' => Rekening::select('id as rekening_id','nomor')->orderBy('nomor')->get(),
        ];
        return view('akuntansi.rekening.create', $data);
    }

    public function store(Request $request){
        // Rule Validation
        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                Rule::unique('rekenings','nama'),
                'max:100',
            ],
            'induk' => 'required',
            'nomor' => 'required',
        ]);

        // Validating input
        $validated = $validator->validated();

        // Merubah kolom induk menjadi int
        $induk = (int)$validated['induk'];

        // Insert New data
        $data = new Rekening;
        $data->nama = $validated['nama'];
        $data->nomor = $validated['nomor'];
        $data->edit = true;
        $data->rekening_induk = $induk;

        $data->save();

        // Insert data aktivitas
        $aktivitas = new Aktivitas();
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap." <b>menambahkan</b> rekening <b>".$validated['nama']."</b> dengan nomor <b>".$validated['nomor']."</b>";
        $aktivitas->deskripsi = $rincian;
        $aktivitas->save();

        // redirect to /rekening
        return redirect('/rekening');
    }

    public function delete(Rekening $id, Request $request){
        // TODO: hanya boleh hapus rekening saat tidak ada data transaksi rekening tersebut

        // Insert data aktivitas
        $aktivitas = new Aktivitas();
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap." <b>menghapus</b> rekening <b>".$id->nomor." ".$id->nama."</b>";
        $aktivitas->deskripsi = $rincian;
        $aktivitas->save();

        Rekening::destroy($id->id);
        return redirect('/rekening');
    }
}

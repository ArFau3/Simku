<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
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
        ];
        return view('akuntansi.rekening.index', $data);
    }


    public function edit(Rekening $id, Request $request)
    {
        if($id['edit'] == 1){
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Daftar Rekening',
            'rekenings' => Rekening::orderBy('nomor')->get(),
            'rekening' => $id,
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

        // Update database
        $data = new Rekening;
        $data->nama = $validated['nama'];
        $data->nomor = $validated['nomor'];
        $data->rekening_induk = $induk;

        $data->save();

        // redirect to /rekening
        return redirect('/rekening');
    }

    public function delete(Rekening $id){
        Rekening::destroy($id->id);
        return redirect('/rekening');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\profile\KoperasiUpdateRequest;
use App\Models\Koperasi;
use App\Models\User;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class KoperasiController extends Controller
{
    public function edit(Request $request, Koperasi $id): View
    {
        $data = [
            'user' => $request->user(),
            'title' => 'Profil Koperasi',
            'judul' => 'Edit Profil Koperasi',
            // HACK: data koperasi tidak lewat model binding, tapi eloquent dari user
        ];
        return view('profile.koperasi.koperasi', $data);
    }

    public function update(KoperasiUpdateRequest $request, Koperasi $id){
        // Handling file foto
        if($request["foto"]){
            $foto = $request->file('foto')->store('koperasi');
        }else{
            $foto = $request['foto_lama'];
        }

        // Save Data
        $id->nama = $request["name"];
        $id->alamat = $request["alamat"];
        $id->hukum = $request["hukum"];
        $id->logo = $foto;
        $id->save();
        // TODO: buat record di aktivitas

        return redirect("/pengaturan-koperasi");
    }
}

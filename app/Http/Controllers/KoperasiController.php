<?php

namespace App\Http\Controllers;

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

    public function update(Request $request, Koperasi $id){
         // Rule Validation
         $validator = Validator::make($request->all(), [
            'name' => 'string', 'max:255',
            'alamat' => 'string', 'max:255',
            'hukum' => 'string', 'max:255',
        ]);

        // Validating input
        $validated = $validator->validated();

        $id->nama = $validated["name"];
        $id->alamat = $validated["alamat"];
        $id->hukum = $validated["hukum"];
        $id->save();
        // TODO: buat record di aktivitas

        return redirect("/pengaturan-koperasi");
    }

    public function indexAkuntan(Request $request, Koperasi $koperasi){
        $data = [
            'user' => $request->user(),
            'title' => 'Kelola Akuntan',
            'judul' => 'Daftar Akuntan',
            'akuntan' => User::orderBy('created_at')->koperasis($koperasi->id)->get(),
        ];
        return view('profile.koperasi.indexAkuntan', $data);
    }
}

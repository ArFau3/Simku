<?php

namespace App\Http\Controllers;

use App\Models\Koperasi;
use App\Models\User;
use Illuminate\View\View;

use Illuminate\Http\Request;

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
        // TODO: buat sistem update
        // TODO: buat record di aktivitas
        dd($request);
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

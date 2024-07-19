<?php

namespace App\Http\Controllers;
use Illuminate\View\View;

use Illuminate\Http\Request;

class KoperasiController extends Controller
{
    public function edit(Request $request): View
    {
        $data = [
            'user' => $request->user(),
            'title' => 'Profil Koperasi',
            'judul' => 'Edit Profil Koperasi'
        ];
        // TODO: siapkan tampilan UI
        return view('profile.akuntansi.edit', $data);
    }
}

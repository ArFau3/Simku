<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Daftar Rekening',
            'rekening' => Rekening::all()->sortBy('nomor'),
        ];
        return view('akuntansi.rekening.index', $data);
    }

    public function tambah(Request $request)
    {
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Tambah Rekening',
            'rekening' => Rekening::all()->sortBy('nomor'),
        ];
        return view('akuntansi.rekening.update', $data);
    }
}

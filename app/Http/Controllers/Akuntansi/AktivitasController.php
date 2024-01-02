<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index(Request $request){
        $data = [
            "title" => "Aktivitas",
            'user' => $request->user(),
            'judul' => 'Aktivitas',
            'aktivitas' => Aktivitas::orderBy('updated_at')->get(),
        ];
        return view('akuntansi.aktivitas', $data);
    }
}

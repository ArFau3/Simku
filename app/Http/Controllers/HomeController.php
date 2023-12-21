<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VarietasSawit;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $modelsawit = VarietasSawit::all();
        $data = [
            "title" => "Dashboard",
            'user' => $request->user(),
            'aktif' => 'rekening',
            'judul' => 'Daftar Rekening',
            'sawit' => $modelsawit
        ];
        return view('home', $data);
    }
}

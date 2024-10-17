<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "title" => "Beranda",
            'user' => $request->user(),
            'judul' => 'Beranda',
            'kas' => Transaksi::inventaris('1.1.1')->get(),
        ];
        return view('akuntansi.home', $data);
    }
}

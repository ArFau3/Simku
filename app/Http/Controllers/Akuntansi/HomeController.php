<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "title" => "Beranda",
            'user' => $request->user(),
            'judul' => 'Beranda',
        ];
        return view('akuntansi.home', $data);
    }
}

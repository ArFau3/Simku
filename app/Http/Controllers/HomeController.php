<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "title" => "Dashboard",
            'user' => $request->user(),
            'aktif' => 'rekening',
            'judul' => 'Daftar Rekening'
        ];
        return view('home', $data);
    }
}

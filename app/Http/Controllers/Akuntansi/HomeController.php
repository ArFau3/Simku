<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            "title" => "Dashboard",
            'user' => $request->user(),
            'judul' => 'Dashboard',
        ];
        return view('akuntansi.home', $data);
    }
}

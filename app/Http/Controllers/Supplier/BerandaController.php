<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class BerandaController extends Controller
{
    public function index()
    {
        return view('supplier.pages.beranda.beranda');
    }
}

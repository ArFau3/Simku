<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class SuratKonfirmasiController extends Controller
{
    public function index()
    {
        return view('supplier.pages.surat_konfirmasi.suratkonfirmasi');
    }
}

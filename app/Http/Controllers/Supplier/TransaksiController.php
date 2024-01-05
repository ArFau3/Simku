<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('supplier.pages.transaksi.transaksi');
    }
}

<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class PanenController extends Controller
{
    public function index()
    {
        return view('supplier.pages.panen.panen');
    }
}

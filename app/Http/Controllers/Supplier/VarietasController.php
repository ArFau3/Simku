<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class VarietasController extends Controller
{
    public function index()
    {
        return view('supplier.pages.varietas.varietas');
    }
}

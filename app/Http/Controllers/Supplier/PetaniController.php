<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class PetaniController extends Controller
{
    public function index()
    {
        return view('supplier.pages.petani.petani');
    }
}

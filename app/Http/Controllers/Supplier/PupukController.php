<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class PupukController extends Controller
{
    public function index()
    {
        return view('supplier.pages.pupuk.pupuk');
    }
}

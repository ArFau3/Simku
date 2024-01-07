<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class SawitController extends Controller
{
    public function index()
    {
        return view('supplier.pages.sawit.sawit');
    }
}

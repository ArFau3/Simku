<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;

class AngkutanController extends Controller
{
    public function index()
    {
        return view('supplier.pages.angkutan.angkutan');
    }
}

<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use App\Models\TransaksiInventaris;
use Illuminate\Http\Request;

class TransaksiInventarisController extends Controller
{
    public function indexTransaksi(Request $request)
    {
        $data = [
            "title" => "Transaksi",
            'user' => $request->user(),
            'judul' => 'Daftar Transaksi',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->get(),
        ];
        return view('akuntansi.transaksi_inventaris.index', $data);
    }

    public function indexInventaris(Request $request)
    {
        $data = [
            "title" => "Inventaris",
            'user' => $request->user(),
            'judul' => 'Daftar Inventaris',
            'transaksi' => TransaksiInventaris::orderBy('tanggal')->get(),
        ];
        return view('akuntansi.transaksi_inventaris.index', $data);
    }

    public function tambah(Request $request)
    {
        $data = [
            "title" => "Transaksi",
            'user' => $request->user(),
            'judul' => 'Tambah Transaksi',
            'transaksi' => TransaksiInventaris::all()->sortBy('tanggal'),
            'rekening' => Rekening::all(),
        ];
        return view('akuntansi.transaksi_inventaris.update', $data);
    }
}

<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Koperasi;
use App\Models\User;
use Illuminate\Http\Request;

class AkuntanController extends Controller
{
    public function index(Request $request, Koperasi $koperasi){
        $data = [
            'user' => $request->user(),
            'title' => 'Kelola Akuntan',
            'judul' => 'Daftar Akuntan',
            'akuntan' => User::orderBy('created_at')->koperasis($koperasi->id)->get(),
        ];
        return view('profile.koperasi.akuntan', $data);
    }

    public function tambah(){}
    public function store(){}

    public function delete(User $id, Request $request){
        // TODO: Insert data aktivitas
        // $aktivitas = new Aktivitas();
        // $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap.
        //             " <b>menghapus</b> transaksi <b>".$id->rekeningDebit->nama. 
        //             " - ".$id->rekeningKredit->nama.
        //             "</b> dari tanggal <b>".$id->tanggal."</b>";
        // $aktivitas->deskripsi = $rincian;
        // $aktivitas->save();

        User::destroy($id->id);
        return redirect('/pengaturan-akuntan');
    }
}

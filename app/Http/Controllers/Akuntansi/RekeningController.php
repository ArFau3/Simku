<?php

namespace App\Http\Controllers\Akuntansi;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\OldRekening;
use App\Models\Rekening;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RekeningController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Daftar Rekening',
            'rekenings' => Rekening::orderBy('desimal')->cari($request['cari'])->paginate(50),
            'rekening_json' => Rekening::all(),
            // FIXME: perbaiki edit dan tambah karna sekarang pakai desimal untuk sorting
            // tambah jadi support keturunan ke 6 (1+10+10+10+10+10)
        ];
        return view('akuntansi.rekening.index', $data);
    }


    public function edit(Rekening $id, Request $request)
    {
        if($id['edit'] == 1){
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Edit Rekening',
            'rekenings' => Rekening::where('desimal', "like", '%00' )->orderBy('desimal')->get(),
            'rekening' => $id,
            'rekening_json' => Rekening::select('id as rekening_id','nomor')->orderBy('nomor')->get(),
        ];
            return view('akuntansi.rekening.update', $data);
        }else{
            return redirect('/rekening');
        }
    }

    public function update(Rekening $id, Request $request){
        // Rule Validation
        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                Rule::unique('rekenings','nama')->ignore($request->id),
                'max:100',
            ],
            'induk' => 'required',
            'nomor' => 'required',
        ]);

        // Validating input
        $validated = $validator->validated();

        // Merubah kolom induk menjadi int
        $induk = (int)$validated['induk'];

        // menyiapkan angka desimal rekening
        $desimal_awal = explode(".", $validated['nomor']);
        $d1 = $desimal_awal[0] * 1000000;
        if(count($desimal_awal) > 1){
            $d2 = (int)$desimal_awal[1] * 10000;
        }
        else{
            $d2 = 0;
        }
        if(count($desimal_awal) > 2){
            $d3 = (int)$desimal_awal[2] * 100;
        }
        else{
            $d3 = 0;
        }
        if(count($desimal_awal) > 3){
            $d4 = (int)$desimal_awal[3] ;
        }
        else{
            $d4 = 0;
        }
        
        $desimal_anak = $d1+$d2+$d3+$d4;

// TODO: kolom desimal untuk olddata
        // Siapkan data history
        // QOL: saat di rincian aktivitas, ada 1-click button to rollback data
        // replicate data to oldRekening
        $replicated_data = OldRekening::create([
            'nama' => $id->nama,
            'nomor' => $id->nomor,
            'rekening_induk' => $id->rekeningInduk->nama,
            'desimal' => $id->desimal,
        ]);

        // insert data aktivitas
        $aktivitas = new Aktivitas();
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap." <b>merubah</b> rekening <b>".$id->nomor." ".$id->nama. "</b> menjadi <b>".$validated['nomor']." ".$validated['nama']."</b>";
        $aktivitas->deskripsi = ucfirst($rincian);
        // reference
        $aktivitas->old_rekening = $replicated_data->id;
        $aktivitas->current_rekening = $id->id;
        // save aktivitas
        $aktivitas->save();

        // Update database
        $id->nama = $validated['nama'];
        $id->nomor = $validated['nomor'];
        $id->desimal = $desimal_anak;
        $id->rekening_induk = $induk;

        $id->save();

        // redirect to /rekening
        return redirect('/rekening');
    }

    public function tambah(Request $request)
    {
        $data = [
            "title" => "Rekening",
            'user' => $request->user(),
            'judul' => 'Tambah Rekening',
            'rekening' => Rekening::where('desimal', "like", '%00' )->orderBy('desimal')->get(),
            'last' =>Rekening::all()->last(),
            'rekening_json' => Rekening::select('id as rekening_id','nomor')->orderBy('nomor')->get(),
        ];
        return view('akuntansi.rekening.create', $data);
    }

    public function store(Request $request){
        // Rule Validation
        $validator = Validator::make($request->all(), [
            'nama' => [
                'required',
                Rule::unique('rekenings','nama'),
                'max:100',
            ],
            'induk' => 'required',
            'nomor' => 'required',
        ]);

        // Validating input
        $validated = $validator->validated();

        // Merubah kolom induk menjadi int
        $induk = (int)$validated['induk'];

        // menyiapkan angka desimal rekening
//  TODO: cek jika nama rekening sudah ada, apakah boleh double karena nomor beda?
        // dd(substr($validated['nomor'], 0, strpos($validated['nomor'], '.')));
        $desimal_awal = explode(".", $validated['nomor']);
        $d1 = $desimal_awal[0] * 1000000;
        if(count($desimal_awal) > 1){
            $d2 = (int)$desimal_awal[1] * 10000;
        }
        else{
            $d2 = 0;
        }
        if(count($desimal_awal) > 2){
            $d3 = (int)$desimal_awal[2] * 100;
        }
        else{
            $d3 = 0;
        }
        if(count($desimal_awal) > 3){
            $d4 = (int)$desimal_awal[3] ;
        }
        else{
            $d4 = 0;
        }
        
        $desimal_anak = $d1+$d2+$d3+$d4;

        // Insert New data
        $data = new Rekening;
        $data->nama = $validated['nama'];
        $data->nomor = $validated['nomor'];
        $data->edit = true;
        $data->desimal = $desimal_anak;
        $data->rekening_induk = $induk;

        $data->save();

        // Insert data aktivitas
        $aktivitas = new Aktivitas();
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap." <b>menambahkan</b> rekening <b>".$validated['nama']."</b> dengan nomor <b>".$validated['nomor']."</b>";
        $aktivitas->deskripsi = $rincian;
        $aktivitas->save();

        // redirect to /rekening
        return redirect('/rekening');
    }

    public function delete(Rekening $id, Request $request){
        // cek apakah ada data transaksi
        if (($id->transaksiDebit()->exists()||$id->transaksiKredit()->exists())) {
            // jika ada lgsg return
            // TODO: with flashed confirm
            return back();
        }

        // cek apakah ada rekening anak
        if(Rekening::where('rekening_induk', $id->id)->get()->isNotEmpty()){
            return back();
        }

        // Insert data aktivitas
        $aktivitas = new Aktivitas();
        $rincian = $request->user()->getRoles()[0]." ".$request->user()->nama_lengkap." <b>menghapus</b> rekening <b>".$id->nomor." ".$id->nama."</b>";
        $aktivitas->deskripsi = $rincian;
        $aktivitas->save();

        Rekening::destroy($id->id);
        return redirect('/rekening');
    }

    public function downloadPDF(Request $request) {
        // $pegawai = Pegawai::all();
 
    	// $pdf = PDF::loadview('pegawai_pdf',['pegawai'=>$pegawai]);
    	// return $pdf->download('laporan-pegawai-pdf');


        $rekenings = Rekening::all();
        $pdf = Pdf::loadView('layouts/testDownload', compact('rekenings'));
        
        return $pdf->download('Daftar Rekening.pdf');
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiInventaris extends Model
{
    use HasFactory;
    protected $fillable = [
        'debit',
        'kredit',
        'jenis',
        'tanggal',
        'keterangan',
        'nominal',
    ];

    public $timestamps = true;

    public function scopeInventaris(Builder $query, $rekening){
        return $query->whereHas('rekeningDebit', function($q) use ($rekening) {
            $q->where('nomor', 'like', $rekening.'%');
        } )
        ->orWhereHas('rekeningKredit', function($q) use ($rekening) {
            $q->where('nomor', 'like', $rekening.'%');
        } );
    }

    public function scopeCari($query, $data){
        $query->when($data ?? false, function($query, $data)
        {
            return $query->where('keterangan', 'like', "%".$data."%")
                        ->orWhereHas('jenisTransaksi', function($q) use ($data) {
                            $q->where('jenis', 'like', $data.'%');
                        } )
                        ->orWhereHas('rekeningDebit', function($q) use ($data) {
                            $q->where('nama', 'like', $data.'%');
                        } )
                        ->orWhereHas('rekeningKredit', function($q) use ($data) {
                            $q->where('nama', 'like', $data.'%');
                        } );
        });
    }

    public function scopeFilter($query, $awal, $akhir){
        $query->when(isset($awal) ? [$awal,$akhir] : false, function($query, $rentang){
            return $query->where([
                ['tanggal', '>=', $rentang[0]],
                ['tanggal', '<=', $rentang[1]],
            ]);
        });
    }

    public function rekeningDebit(): BelongsTo
    {   
        return $this->belongsTo(Rekening::class, 'debit');
    }

    public function rekeningKredit(): BelongsTo
    {   
        return $this->belongsTo(Rekening::class, 'kredit');
    }

    public function jenisTransaksi(): BelongsTo{
        return $this->belongsTo(Jenis::class, 'jenis');
    }
}

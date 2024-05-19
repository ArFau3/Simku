<?php

namespace App\Models;

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

    public function scopeCari($query, $data){
        $query->when($data ?? false, function($query, $data)
        {
            return $query->where('keterangan', 'like', "%".$data."%");
                        // ->orWhere('nomor', 'like', "%".$data.'%');
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

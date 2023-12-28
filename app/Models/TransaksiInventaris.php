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
        'tanggal',
        'keterangan',
        'nominal',
    ];

    public $timestamps = true;

    public function rekeningDebit(): BelongsTo
    {   
        return $this->belongsTo(Rekening::class, 'debit');
    }

    public function rekeningKredit(): BelongsTo
    {   
        return $this->belongsTo(Rekening::class, 'kredit');
    }
}

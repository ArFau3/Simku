<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aktivitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'deskripsi',
        'old_rekening',
        'current_rekening',
        'old_transaksi',
        'current_transaksi',

        // HACK: for faker
        'created_at',
    ];

    public $timestamps = true;
    public function oldRekening(): BelongsTo
    {   
        return $this->belongsTo(OldRekening::class, 'old_rekening');
    }

    public function currentRekening(): BelongsTo
    {   
        return $this->belongsTo(Rekening::class, 'current_rekening');
    }

    public function oldTransaksi(): BelongsTo{
        return $this->belongsTo(OldTransaksiInventaris::class, 'old_transaksi');
    }

    public function currentTransaksi(): BelongsTo
    {   
        return $this->belongsTo(TransaksiInventaris::class, 'current_transaksi');
    }
}

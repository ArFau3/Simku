<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OldTransaksi extends Model
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

    public $timestamps = false;
}

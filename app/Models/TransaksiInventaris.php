<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

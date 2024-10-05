<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OldRekening extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nomor',
        'rekening_induk',
        "desimal",
    ];

    public $timestamps = false;
}

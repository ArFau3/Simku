<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TutupBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'awal',
        'akhir',
        "transaksi_id",
    ];

    public $timestamps = false;
}

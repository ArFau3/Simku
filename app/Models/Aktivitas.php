<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'deskripsi',


// SEMENTARA
        'updated_at',
    ];

    public $timestamps = true;
}

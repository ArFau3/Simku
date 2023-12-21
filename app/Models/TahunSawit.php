<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunSawit extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun_tanam'
    ];

    public $timestamps = true;
}

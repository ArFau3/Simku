<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutupBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'awal',
        'akhir',
    ];

    public $timestamps = false;
}

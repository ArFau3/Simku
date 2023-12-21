<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarietasSawit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_varietas',
        'harga',
    ];

    public $timestamps = true;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'deskripsi',
        'updated_at',
        // QOL: field delete:bool for soft deleting
    ];

    public $timestamps = true;
}

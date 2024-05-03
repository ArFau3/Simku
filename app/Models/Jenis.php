<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis',
    ];

    public $timestamps = false;

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiInventaris::class);
    }
}

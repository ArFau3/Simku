<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rekening extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nomor',
        'edit',
        'rekening_induk',
        "desimal",
    ];

    public $timestamps = false;

    public function scopeCari($query, $data){
        $query->when($data ?? false, function($query, $data)
        {
            return $query->where('nama', 'like', "%".$data.'%')
                        ->orWhere('nomor', 'like', "%".$data.'%');
        });
    }

    public function rekeningInduk(): BelongsTo
    {
        return $this->belongsTo(Rekening::class, "rekening_induk");
    }

    public function transaksiDebit(): HasMany{
        return $this->hasMany(Transaksi::class, 'debit');
    }
    public function transaksiKredit(): HasMany{
        return $this->hasMany(Transaksi::class, 'kredit');
    }

}

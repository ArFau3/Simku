<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rekening extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'nomor',
        'edit',
        'rekening_induk',
    ];

    public $timestamps = false;

    public function scopeCari($query, $data){
        $query->when($data ?? false, function($query, $data)
        {
            return $query->where('nama', 'like', "%".$data.'%')
                        ->orWhere('nomor', 'like', "%".$data.'%');
        });
    }

    public function transaksi(): HasMany
    {
        return $this->hasMany(TransaksiInventaris::class);
    }
}

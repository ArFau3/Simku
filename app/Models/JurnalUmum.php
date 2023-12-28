<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JurnalUmum extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutup_buku_id',
        'total',
    ];

    public $timestamps = true;

    public function tutup_buku(): HasOne
    {
        return $this->hasOne(TutupBuku::class);
    }
}

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
        "nominal",
    ];

    public $timestamps = false;

    public function jurnal_umum(): HasOne
    {
        return $this->hasOne(JurnalUmum::class);
    }
}

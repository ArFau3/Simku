<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TBS extends Model
{
    use HasFactory;

    protected $fillable = [
        'rekening'
    ];

    public $timestamps = true;

    public function rekenings(): BelongsTo
    {
        return $this->belongsTo(Rekening::class, "rekening");
    }
}

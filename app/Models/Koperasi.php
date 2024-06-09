<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Koperasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'logo',
    ];

    public $timestamps = true;

    // public function user(): HasMany
    // {
    //     return $this->hasMany(User::class);
    // }
}

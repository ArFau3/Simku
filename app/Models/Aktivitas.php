<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aktivitas extends Model
{
    use HasFactory;
    protected $fillable = [
        'deskripsi',
        'old_rekening',
        'current_rekening',
        'old_transaksi',
        'current_transaksi',

        // HACK: for faker
        'created_at',
    ];

    public function scopeFilter($query, $awal, $akhir){
        $query->when(isset($awal) ? [$awal,$akhir] : false, function($query, $rentang){
            return $query->where([
                ['created_at', '>=', $rentang[0]],
                ['created_at', '<=', $rentang[1]],
            ]);
        });
    }

    public function scopeCari($query, $data){
        $query->when($data ?? false, function($query, $data)
        {
            return $query->where('deskripsi', 'like', "%".$data."%");
        });
    }

    public $timestamps = true;
    public function oldRekening(): BelongsTo
    {   
        return $this->belongsTo(OldRekening::class, 'old_rekening');
    }

    public function currentRekening(): BelongsTo
    {   
        return $this->belongsTo(Rekening::class, 'current_rekening');
    }

    public function oldTransaksi(): BelongsTo{
        return $this->belongsTo(OldTransaksi::class, 'old_transaksi');
    }

    public function currentTransaksi(): BelongsTo
    {   
        return $this->belongsTo(Transaksi::class, 'current_transaksi');
    }
}

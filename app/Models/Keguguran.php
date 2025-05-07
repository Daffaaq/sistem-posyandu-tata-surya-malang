<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keguguran extends Model
{
    use HasFactory;

    protected $table = 'kegugurans';

    protected $fillable = [
        'kehamilan_id',
        'tanggal_keguguran',
        'usia_kandungan_saat_gugur',
        'penyebab_keguguran',
        'catatan_medis',
    ];

    /**
     * Relasi ke Kehamilan
     */
    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class);
    }
}

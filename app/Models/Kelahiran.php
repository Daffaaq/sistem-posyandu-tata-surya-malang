<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelahiran extends Model
{
    use HasFactory;

    protected $table = 'kelahirans';

    protected $fillable = [
        'kehamilan_id',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'berat_lahir',
        'panjang_lahir',
    ];

    /**
     * Relasi ke Kehamilan
     */
    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class);
    }

    /**
     * Relasi ke Anak (jika satu kelahiran -> satu anak)
     */
    public function anak()
    {
        return $this->hasOne(Anak::class);
    }
}

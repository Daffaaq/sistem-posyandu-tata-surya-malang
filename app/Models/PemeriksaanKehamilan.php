<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanKehamilan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_kehamilans';

    protected $fillable = [
        'kehamilan_id',
        'tanggal_pemeriksaan_kehamilan',
        'deskripsi_pemeriksaan_kehamilan',
        'keluhan_kehamilan',
        'tekanan_darah_ibu_hamil',
        'berat_badan_ibu_hamil',
        'posisi_janin',
        'usia_kandungan',
    ];

    public function kehamilan()
    {
        return $this->belongsTo(Kehamilan::class);
    }
}

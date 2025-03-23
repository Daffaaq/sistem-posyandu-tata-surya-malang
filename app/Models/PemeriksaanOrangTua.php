<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanOrangTua extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan_orang_tuas';

    protected $fillable = [
        'orang_tua_id',
        'kunjungan_id',
        'tekanan_darah_ayah',
        'tekanan_darah_ibu',
        'gula_darah_ayah',
        'gula_darah_ibu',
        'kolesterol_ayah',
        'kolesterol_ibu',
        'catatan_kesehatan_ayah',
        'catatan_kesehatan_ibu',
        'tanggal_pemeriksaan_ayah',
        'tanggal_pemeriksaan_ibu',
        'tanggal_pemeriksaan_lanjutan_ayah',
        'tanggal_pemeriksaan_lanjutan_ibu',
    ];

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }
}

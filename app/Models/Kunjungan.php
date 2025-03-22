<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungans';

    protected $fillable = [
        'tanggal_kunjungan',
        'deskripsi_kunjungan',
        'tipe_kunjungan_id',
        'orang_tua_id',
    ];

    public function tipe_kunjungan()
    {
        return $this->belongsTo(TypeKunjungan::class, 'tipe_kunjungan_id');
    }

    public function orang_tua()
    {
        return $this->belongsTo(OrangTua::class, 'orang_tua_id');
    }

    public function kunjungan_anaks()
    {
        return $this->hasMany(KunjunganAnak::class, 'kunjungan_id');
    }
}

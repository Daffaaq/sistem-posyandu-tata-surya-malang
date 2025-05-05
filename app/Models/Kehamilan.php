<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehamilan extends Model
{
    use HasFactory;

    protected $table = 'kehamilans';

    protected $fillable = [
        'orang_tua_id',
        'status_kehamilan',
        'tanggal_mulai_kehamilan',
        'prediksi_tanggal_lahir',
    ];

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function pemeriksaanKehamilans()
    {
        return $this->hasMany(PemeriksaanKehamilan::class);
    }
}

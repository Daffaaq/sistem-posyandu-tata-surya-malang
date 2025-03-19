<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    protected $table = 'jadwal_posyandus';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'waktu_kegiatan',
        'tempat_kegiatan',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKunjunganKeluargaBerencana extends Model
{
    use HasFactory;

    protected $table = 'jenis_kunjungan_keluarga_berencanas';

    protected $fillable = [
        'nama_jenis_kunjungan_keluarga_berencana',
        'deskripsi',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKunjunganKb extends Model
{
    use HasFactory;

    protected $table = 'jadwal_kunjungan_kbs';

    protected $fillable = [
        'keluarga_berencana_id',
        'jenis_kunjungan_kb_id',
        'tanggal_kunjungan_kb',
    ];

    public function keluargaBerencana()
    {
        return $this->belongsTo(KeluargaBerencana::class);
    }

    public function jenisKunjunganKb()
    {
        return $this->belongsTo(JenisKunjunganKeluargaBerencana::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganObat extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_obats';

    protected $fillable = [
        'kunjungan_id',
        'obat_id',
        'kunjungan_anak_id',
        'jumlah_obat',
        'is_for_ibu',
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }

    public function kunjunganAnak()
    {
        return $this->belongsTo(KunjunganAnak::class, 'kunjungan_anak_id');
    }
}

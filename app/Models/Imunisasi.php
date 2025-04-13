<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imunisasi extends Model
{
    use HasFactory;

    protected $table = 'imunisasis';

    protected $fillable = [
        'kunjungan_anak_id',
        'kategori_imunisasi_id',
        'tanggal_imunisasi',
        'tanggal_imunisasi_lanjutan',
    ];

    public function kunjunganAnak()
    {
        return $this->belongsTo(KunjunganAnak::class, 'kunjungan_anak_id');
    }

    public function kategoriImunisasi()
    {
        return $this->belongsTo(KategoriImunasasi::class, 'kategori_imunisasi_id');
    }
}

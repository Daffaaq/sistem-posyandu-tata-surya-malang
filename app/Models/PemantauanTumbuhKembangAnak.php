<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemantauanTumbuhKembangAnak extends Model
{
    use HasFactory;

    protected $table = 'pemantauan_tumbuh_kembang_anaks';

    protected $fillable = [
        'kunjungan_anak_id',
        'tinggi_badan',
        'berat_badan',
        'perkembangan_motorik',
        'perkembangan_psikis',
        'tanggal_pemantauan',
    ];

    public function kunjunganAnak()
    {
        return $this->belongsTo(KunjunganAnak::class, 'kunjungan_anak_id');
    }
}

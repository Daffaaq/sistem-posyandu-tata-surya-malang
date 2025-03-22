<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganAnak extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_anaks';

    protected $fillable = [
        'kunjungan_id',
        'anak_id',
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjungan_id');
    }
}

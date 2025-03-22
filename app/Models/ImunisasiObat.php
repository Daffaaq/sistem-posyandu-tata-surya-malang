<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImunisasiObat extends Model
{
    use HasFactory;

    protected $table = 'imunisasi_obats';

    protected $fillable = [
        'imunisasi_id',
        'obat_id',
        'jumlah_obat',
    ];

    public function imunisasi()
    {
        return $this->belongsTo(Imunisasi::class, 'imunisasi_id');
    }

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}

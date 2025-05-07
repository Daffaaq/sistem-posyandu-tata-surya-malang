<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obats';

    protected $fillable = [
        'nama_obat_vitamin',
        'tipe',
        'deskripsi',
        'stok',
        'tanggal_kadaluarsa',
    ];

    public function arsip()
    {
        return $this->hasOne(ArsipObat::class); // satu obat, satu arsip
    }
}

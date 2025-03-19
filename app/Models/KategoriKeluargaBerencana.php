<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKeluargaBerencana extends Model
{
    use HasFactory;

    protected $table = 'kategori_keluarga_berencanas';

    protected $fillable = [
        'nama_kategori_keluarga_berencana',
        'deskripsi',
    ];
}

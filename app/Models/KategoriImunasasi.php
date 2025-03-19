<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KategoriImunasasi extends Model
{
    use HasFactory;

    protected $table = 'kategori_imunasasis';
    
    protected $fillable = [
        'nama_kategori_imunisasi',
        'keterangan',
        'is_active',
        'slug',
    ];

    protected static function booted()
    {
        static::saving(function ($kategoriImunasasi) {
            // Generate slug from nama_kategori_imunisasi if not already set
            if (empty($kategoriImunasasi->slug)) {
                $kategoriImunasasi->slug = Str::slug($kategoriImunasasi->nama_kategori_imunisasi);
            }
        });
    }
}

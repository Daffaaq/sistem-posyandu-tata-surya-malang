<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeluargaBerencana extends Model
{
    use HasFactory;

    protected $table = 'keluarga_berencanas';

    protected $fillable = [
        'orang_tua_id',
        'kategori_keluarga_berencana_id',
        'tanggal_mulai_keluarga_berencana',
        'tanggal_selesai_keluarga_berencana',
        'catatan_keluarga_berencana',
        'is_active',
    ];

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function kategoriKeluargaBerencana()
    {
        return $this->belongsTo(KategoriKeluargaBerencana::class);
    }
}

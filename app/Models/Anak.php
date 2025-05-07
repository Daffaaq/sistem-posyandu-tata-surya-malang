<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    use HasFactory;

    protected $table = 'anaks';

    protected $fillable = [
        'nama_anak',
        'jenis_kelamin_anak',
        'tanggal_lahir_anak',
        'orang_tua_id',
        'kelahiran_id',
    ];

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function kelahiran()
    {
        return $this->belongsTo(Kelahiran::class);
    }
}

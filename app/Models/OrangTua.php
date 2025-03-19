<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $table = 'orang_tuas';

    protected $fillable = [
        'nama_ibu',
        'jenis_kelamin_ibu',
        'tanggal_lahir_ibu',
        'no_telepon_ibu',
        'email_ibu',
        'pekerjaan_ibu',
        'agama_ibu',
        'alamat_ibu',

        'nama_ayah',
        'jenis_kelamin_ayah',
        'tanggal_lahir_ayah',
        'no_telepon_ayah',
        'email_ayah',
        'pekerjaan_ayah',
        'agama_ayah',
        'alamat_ayah',

        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anak()
    {
        return $this->hasMany(Anak::class);
    }
}

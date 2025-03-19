<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeKunjungan extends Model
{
    use HasFactory;

    protected $table = 'type_kunjungans';

    protected $fillable = [
        'nama_tipe_kunjungan',
        'deskripsi'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipObat extends Model
{
    use HasFactory;

    protected $table = 'arsip_obats';

    protected $fillable = [
        'obat_id',
        'tanggal_arsip_obat',
        'user_id',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

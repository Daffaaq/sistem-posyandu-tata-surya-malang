<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBerita extends Model
{
    use HasFactory;

    protected $table = 'history_beritas';

    protected $fillable = [
        'berita_id',
        'old_status',
        'new_status',
        'user_id',
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

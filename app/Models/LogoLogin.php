<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoLogin extends Model
{
    use HasFactory;

    protected $table = 'logo_logins';

    protected $fillable = [
        'judul_logo_login',
        'logo_login',
        'status_logo_login',
    ];

    public function scopeActive($query)
    {
        return $query->where('status_logo_login', 'active');
    }
}

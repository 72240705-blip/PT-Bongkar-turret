<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telp',
        'kata_sandi',
        'peran',
        'status_akun',
        'otp_code',
        'email_verified_at',
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    // Mengarahkan sistem autentikasi Laravel ke kolom 'kata_sandi'
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'user_id');
    }
}
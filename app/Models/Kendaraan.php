<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';

    protected $fillable = [
        'user_id',
        'merk_model',
        'plat_nomor',
        'kapasitas_baterai_kwh',
        'tipe_konektor',
        'is_utama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stasiun extends Model
{
    use HasFactory;

    protected $table = 'stasiuns';
    protected $primaryKey = 'id_stasiun';

    protected $fillable = ['nama_stasiun', 'alamat', 'kota', 'latitude', 'longitude', 'status'];

    public function konektors()
    {
        return $this->hasMany(Konektor::class, 'id_stasiun', 'id_stasiun');
    }
}
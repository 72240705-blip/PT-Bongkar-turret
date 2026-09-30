<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konektor extends Model
{
    use HasFactory;

    protected $table = 'konektors';
    protected $primaryKey = 'id_konektor';

    protected $fillable = ['id_stasiun', 'tipe_konektor', 'daya_kw', 'harga_per_kwh', 'status'];

    public function stasiun()
    {
        return $this->belongsTo(Stasiun::class, 'id_stasiun', 'id_stasiun');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
        'user_id',
        'name',
        'code',
        'sks',
        'semester',
        'kategori',
    ];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); //Dosen
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }
}

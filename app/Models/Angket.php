<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tujuan',
        'start_at',
        'end_at',
        'kondisi',
        'kondisi_detail',
        'matakuliah_id',
        'prodi_id',
        'matakuliahs',
        'prodi',
    ];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }

    public function hasil()
    {
        return $this->hasMany(HasilAngket::class);
    }

    public function matakuliah() //from matakuliah_id
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function prodi() //from prodi_id
    {
        return $this->belongsTo(Prodi::class);
    }
}

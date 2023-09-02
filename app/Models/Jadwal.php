<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruang_id',
        'prodi_id',
        'matakuliah_id',
        'kelas_id',
        'jam',
        'hari',
    ];

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}

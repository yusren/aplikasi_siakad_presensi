<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'matakuliah_id',
        'tahun_ajaran_id',
        'semester',
        'status',
        'nilai_tugas',
        'nilai_uts',
        'nilai_uas',
        'nilai_keaktifan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    // public function jadwal()
    // {
    //     return $this->belongsToMany(Jadwal::class);
    // }
}

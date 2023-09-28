<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jadwal_id',
        'name',
        'topic',
        'sub_topic',
        'dosen_pengganti',
    ];

    public function user() //dosen
    {
        return $this->belongsTo(User::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class);
    }

    public function tugas()
    {
        return $this->hasOne(UploadTugas::class);
    }

    public function absentStudents()
    {
        $allStudents = $this->jadwal->kelas->users;
        $presentStudents = $this->presensi->pluck('user_id');

        return $allStudents->whereNotIn('id', $presentStudents);
    }
}

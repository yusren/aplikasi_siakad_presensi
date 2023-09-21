<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'prodi_id',
        'name',
        'nomor',
        'username',
        'role',
        'status',
        'email',
        'alamat',
        'no_telp',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'photo',
        'password',
        'gelar_akademik',
        'jabatan_akademik',
        'pendidikan_tinggi',
        'status_ikatan_kerja',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function alamats()
    {
        return $this->hasOne(Alamat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); //Pembimbing
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }

    public function krs()
    {
        return $this->hasMany(Krs::class);
    }

    public function matakuliah()
    {
        return $this->hasMany(Matakuliah::class);
    }

    public function keluarga()
    {
        return $this->hasOne(Keluarga::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function pertemuan()
    {
        if ($this->role == 'dosen') {
            return $this->hasMany(Pertemuan::class);
        }

        return null;
    }

    public function presensi()
    {
        if ($this->role == 'mahasiswa') {
            return $this->hasMany(Presensi::class);
        }

        return null;
    }

    public function hasilAngket()
    {
        return $this->hasMany(HasilAngket::class);
    }
}

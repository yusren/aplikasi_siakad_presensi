<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'topic',
        'user_id',
        'tahun_ajaran_id',
    ];

    public function user() //dosen
    {
        return $this->belongsTo(User::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(tahunAjaran::class);
    }

    public function detail()
    {
        return $this->hasMany(Bimbingandetail::class);
    }
}

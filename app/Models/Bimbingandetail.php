<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bimbingandetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bimbingan_id',
    ];

    public function user() //mahasiswa
    {
        return $this->belongsTo(User::class);
    }

    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class);
    }
}

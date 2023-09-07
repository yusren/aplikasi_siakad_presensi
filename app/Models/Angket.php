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
    ];

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class);
    }
}

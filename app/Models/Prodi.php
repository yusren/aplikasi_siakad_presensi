<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $fillable = [
        'fakultas_id',
        'name',
        'code',
        'jenjang',
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }
}

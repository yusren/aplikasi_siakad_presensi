<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'prodi_id',
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $fillable = ['angket_id', 'description'];

    public function angket()
    {
        return $this->belongsTo(Angket::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
}

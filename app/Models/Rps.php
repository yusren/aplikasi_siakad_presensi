<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rps extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function detail()
    {
        return $this->hasMany(RpsDetail::class);
    }
}

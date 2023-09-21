<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpsDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'rps_id',
        'user_id',
        'file',
    ];

    public function rps()
    {
        return $this->belongsTo(Rps::class); //Kapordi
    }
}

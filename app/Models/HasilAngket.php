<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilAngket extends Model
{
    protected $guarded = ['id'];

    protected $table = 'hasil_angket';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agnket()
    {
        return $this->belongsTo(Angket::class);
    }
}

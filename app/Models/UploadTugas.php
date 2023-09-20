<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadTugas extends Model
{
    use HasFactory;

    protected $fillable = ['pertemuan_id', 'user_id', 'file'];

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

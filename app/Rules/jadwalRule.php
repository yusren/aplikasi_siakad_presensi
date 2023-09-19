<?php

namespace App\Rules;

use App\Models\Jadwal;
use Illuminate\Contracts\Validation\Rule;

class JadwalRule implements Rule
{
    public $ruang_id;

    public $hari;

    public $jam_berakhir;

    public $tahun_ajaran_id;

    public function __construct($ruang_id, $hari, $jam_berakhir, $tahun_ajaran_id)
    {
        $this->ruang_id = $ruang_id;
        $this->hari = $hari;
        $this->jam_berakhir = $jam_berakhir;
        $this->tahun_ajaran_id = $tahun_ajaran_id;
    }

    public function passes($attribute, $value)
    {
        return ! Jadwal::where('ruang_id', $this->ruang_id)
            ->where('hari', $this->hari)
            ->where('jam', '<=', $value)
            ->where('jam_berakhir', '>=', $value)
            ->where('tahun_ajaran_id', $this->tahun_ajaran_id)
            ->exists();
    }

    public function message()
    {
        return 'The schedule cannot be at the same time in the same room.';
    }
}

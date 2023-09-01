<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $fakultases = \App\Models\Fakultas::factory(5)->create();

        foreach ($fakultases as $fakultas) {
            \App\Models\Prodi::factory()->create(['fakultas_id' => $fakultas->id]);
        }

        \App\Models\Matakuliah::factory(3)->create();
        $mahasiswas = \App\Models\User::factory(5)->create(['role' => 'mahasiswa']);
        $kelases = \App\Models\Kelas::factory(3)->create();

        $kelases->each(function ($kelas) use ($mahasiswas) {
            $kelas->users()->attach($mahasiswas->random(2)->pluck('id')->toArray());
        });

        \App\Models\TahunAjaran::factory(5)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'superadmin',
        ]);
    }
}

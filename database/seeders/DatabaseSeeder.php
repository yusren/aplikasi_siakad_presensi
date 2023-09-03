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
        $faculties = [
            ['name' => 'Fakultas Ilmu Komputer', 'code' => 'FIK'],
            ['name' => 'Fakultas Ekonomi dan Sosial', 'code' => 'FES'],
            ['name' => 'Fakultas Sains dan Teknologi', 'code' => 'FST'],
            ['name' => 'Fakultas Ilmu Bahasa', 'code' => 'FIB'],
        ];

        foreach ($faculties as $faculty) {
            $fakultas = \App\Models\Fakultas::factory()->create([
                'name' => $faculty['name'],
                'code' => $faculty['code'],
            ]);
            \App\Models\Prodi::factory()->create(['fakultas_id' => $fakultas->id]);
        }

        $matakuliahs = [
            ['name' => 'Calculus', 'code' => 'CAL'],
            ['name' => 'Linear Algebra', 'code' => 'LAL'],
            ['name' => 'Introduction to Programming', 'code' => 'ITP'],
            ['name' => 'Data Structures and Algorithms', 'code' => 'DSA'],
            ['name' => 'Database Systems', 'code' => 'DBS'],
        ];
        foreach ($matakuliahs as $matakuliah) {
            \App\Models\Matakuliah::factory()->create([
                'prodi_id' => \App\Models\Prodi::inRandomOrder()->first()->id,
                'name' => $matakuliah['name'],
                'code' => $matakuliah['code'],
            ]);
        }

        $mahasiswas = \App\Models\User::factory(5)->create(['role' => 'mahasiswa']);
        $kelases = \App\Models\Kelas::factory(3)->create();
        \App\Models\Ruang::factory(3)->create();

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

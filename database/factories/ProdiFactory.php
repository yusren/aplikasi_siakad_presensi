<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prodi>
 */
class ProdiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $prodis = [
            ['name' => 'D3 Informatika', 'code' => 'DI'],
            ['name' => 'D3 Manajemen Informatika', 'code' => 'DMI'],
            ['name' => 'Teknik Komputer', 'code' => 'TK'],
            ['name' => 'Informatika', 'code' => 'IF'],
            ['name' => 'Teknologi Informasi', 'code' => 'TI'],
            ['name' => 'Sistem Informasi', 'code' => 'SI'],
            ['name' => 'Akuntansi', 'code' => 'AK'],
            ['name' => 'Ilmu Komunikasi', 'code' => 'ILKOM'],
            ['name' => 'Ekonomi', 'code' => 'EK'],
            ['name' => 'Hubungan Internasional', 'code' => 'HI'],
        ];
        $prodi = $this->faker->unique()->randomElement($prodis);

        return [
            'fakultas_id' => \App\Models\Fakultas::factory(),
            'name' => $prodi['name'],
            'code' => $prodi['code'],
            'jenjang' => $this->faker->name(),
        ];
    }
}

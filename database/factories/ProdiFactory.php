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
            ['name' => 'Prodi1', 'code' => 'P1'],
            ['name' => 'Prodi2', 'code' => 'P2'],
            ['name' => 'Prodi3', 'code' => 'P3'],
            ['name' => 'Prodi4', 'code' => 'P4'],
            ['name' => 'Prodi5', 'code' => 'P5'],
            ['name' => 'Prodi6', 'code' => 'P6'],
            ['name' => 'Prodi7', 'code' => 'P7'],
            ['name' => 'Prodi8', 'code' => 'P8'],
            ['name' => 'Prodi9', 'code' => 'P9'],
            ['name' => 'Prodi10', 'code' => 'P10'],
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

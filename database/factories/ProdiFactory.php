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
        return [
            'fakultas_id' => \App\Models\Fakultas::factory(),
            'name' => $this->faker->word,
            'code' => $this->faker->unique()->numerify('###'),
        ];
    }
}

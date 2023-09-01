<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TahunAjaran>
 */
class TahunAjaranFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'semester' => $this->faker->randomElement(['ganjil', 'genap']),
            'is_active' => $this->faker->boolean,
        ];
    }
}

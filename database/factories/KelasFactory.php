<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $courses = [
            ['name' => 'A', 'code' => 'a'],
            ['name' => 'B', 'code' => 'b'],
            ['name' => 'C', 'code' => 'c'],
            ['name' => 'D', 'code' => 'd'],
            ['name' => 'E', 'code' => 'e'],
        ];
        $course = $this->faker->unique()->randomElement($courses);

        return [
            'name' => $course['name'],
            'code' => $course['code'],
        ];
    }
}

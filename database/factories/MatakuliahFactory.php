<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matakuliah>
 */
class MatakuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $courses = [
            ['name' => 'Calculus', 'code' => 'CAL'],
            ['name' => 'Linear Algebra', 'code' => 'LAL'],
            ['name' => 'Introduction to Programming', 'code' => 'ITP'],
            ['name' => 'Data Structures and Algorithms', 'code' => 'DSA'],
            ['name' => 'Database Systems', 'code' => 'DBS'],
        ];
        $course = $this->faker->unique()->randomElement($courses);

        return [
            'prodi_id' => \App\Models\Prodi::factory(),
            'name' => $course['name'],
            'code' => $course['code'],
        ];
    }
}

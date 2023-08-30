<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fakultas>
 */
class FakultasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faculties = [
            ['name' => 'Faculty of Mathematics and Natural Sciences', 'code' => 'MNS'],
            ['name' => 'Faculty of Social and Political Sciences', 'code' => 'SPS'],
            ['name' => 'Faculty of Humanities', 'code' => 'HUM'],
            ['name' => 'Faculty of Engineering', 'code' => 'ENG'],
            ['name' => 'Faculty of Economics and Business', 'code' => 'EB'],
        ];
        $faculty = $this->faker->randomElement($faculties);

        return [
            'name' => $faculty['name'],
            'code' => $faculty['code'],
        ];
    }
}

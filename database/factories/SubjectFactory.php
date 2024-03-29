<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'         => fake()->word(),
            'lecturer_id'   => 11,
            'semester'      => 'Ganjil',
            'academic_year' => '2022/2023',
            'sks'           => 3,
            'code'          => fake()->word(),
            'description'   => fake()->paragraph(3)
        ];
    }
}

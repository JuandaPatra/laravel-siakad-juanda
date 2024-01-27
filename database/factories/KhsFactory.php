<?php

namespace Database\Factories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Khs>
 */
class KhsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_id' => Subject::factory(),
            'student_id' => User::factory(),
            'nilai'      => $this->faker->randomElement([
                'A',
                'B',
                'C',
                'D',
                'E'
            ]),
            'grade'     => $this->faker->randomElement([
                'A','B','C','D','E'
            ]),
            'keterangan' => $this->faker->randomElement([
                'lulus', 'tidak lulus'
            ]),
            'tahun_akademik' =>$this->faker->randomElement([
                '2021/2022',
                '2022/2023',
                '2023/2024'
            ]),
            'semester'          => $this->faker->randomElement([
                'Ganjil', 'Genap'
            ]),
            'created_by'            => $this->faker->randomElement([
                '1',
                '2',
                '3'
            ]),
            // 'updated_at'            => $this->faker->randomElement([
            //     '1',
            //     '2',
            //     '3'
            // ])
           
        ];
    }
}

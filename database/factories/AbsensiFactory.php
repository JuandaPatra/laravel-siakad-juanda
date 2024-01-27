<?php

namespace Database\Factories;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Absensi>
 */
class AbsensiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // $table->foreignId('schedule_id')->constrained('schedules');
            // $table->foreignId('student_id')->constrained('users');
            // $table->string('kode_absensi');
            // $table->string('tahun_akademik');
            // $table->string('semester');
            // $table->string('pertemuan');
            // $table->string('status');
            // $table->string('keterangan')->nullable();
            // $table->string('latitude');
            // $table->string('longitude');
            // $table->string('nilai')->nullable();
            // $table->string('created_by');
            // $table->string('updated_at');
            'schedule_id' => Schedule::factory(),
            'student_id'  => User::factory(),
            'kode_absensi'      =>$this->faker->randomElement([
                'A1',
                'A2',
                'A3',
                'A4',
                'A5',
                'A6',
                'A7',
                'B1',
                'B2',
                'B3',
                'B4',
                'B5'
            ]),
            'tahun_akademik'        => $this->faker->randomElement([
                '2021/2022',
                '2022/2023',
                '2023/2024'
            ]),
            'semester'              => $this->faker->randomElement([
                'Ganjil',
                'Genap'
            ]),
            'pertemuan'             =>$this->faker->randomElement([
                '1', '2', '3','4','5','6'
            ]),
            'status'                => $this->faker->randomElement([
                'Hadir', 'Tidak Hadir'
            ]),
            'keterangan'            => $this->faker->randomElement([
                'Sakit', 'Izin', 'Tanpa Keterangan', ' '
            ]),
            'latitude'              =>$this->faker->latitude(),
            'longitude'             => $this->faker->longitude(),
            'nilai'                 => $this->faker->randomElement([
                ' ', 'A', 'B', 'C','D','E'

            ]),
            'created_by'            => $this->faker->randomElement([
                '1',
                '2',
                '3'
            ]),
            'updated_by'            => $this->faker->randomElement([
                '1',
                '2',
                '3'
            ])


        ];
    }
}

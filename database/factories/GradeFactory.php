<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => Student::factory(),
            'course_id' => Course::factory(),
            'grade' => $this->faker->randomElement(['AA', 'BA', 'BB', 'CB', 'CC', 'DC', 'DD', 'FF', 'DZ', 'FD']),
        ];
    }
}

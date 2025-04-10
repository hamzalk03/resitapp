<?php

namespace Database\Factories;

use App\Models\Instructor;
use App\Models\Secretary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_code' => $this->faker->unique()->bothify('COURSE-###'),
            'course_name' => $this->faker->unique()->words(3, true),
            'instructor_id' => Instructor::factory(),
            'secretary_id' => Secretary::factory(),
        ];
    }
}

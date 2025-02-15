<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::inRandomOrder()->first()->id,
            'date' => fake()->date(),
            'check_in' => fake()->optional()->time(),
            'check_out' => fake()->optional()->time(),
            'selfie_check_in' => null,
            'selfie_check_out' => null,
        ];
    }
}

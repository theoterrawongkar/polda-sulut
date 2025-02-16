<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Employee::factory(1)->create()->each(function ($employee, $index) {
            $userData = [
                'employee_id' => $employee->id,
            ];

            if ($index === 0) {
                $userData['name'] = 'admin';
                $userData['email'] = 'admin@poldasulut.com';
            }

            User::factory()->create($userData);
        });

        // Attendance::factory(20)->create();
    }
}

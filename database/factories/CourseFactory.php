<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Invoice;
use App\Services\CourseService;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => Student::all()->random()->id,
            'invoice_id' => Invoice::all()->random()->id,
            'date' => now()->format('Y-m-d'),
            'duration' => '01:00',
            'course_duration' => 60,
            'hourly_rate' => 10,
            'price' => CourseService::calculate_total_price(60, 10),
            'learned_notions' => $this->faker->sentence(30),
            'paid' => $this->faker->boolean,
        ];
    }
}

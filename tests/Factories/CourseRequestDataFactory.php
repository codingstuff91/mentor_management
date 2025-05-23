<?php

namespace Tests\Factories;

use App\Models\Invoice;
use App\Models\Student;

class CourseRequestDataFactory
{
    public static function new(): self
    {
        return new self();
    }

    public function create(array $extra = []): array
    {
        return $extra + [
            'student' => Student::first()->id,
            'invoice' => Invoice::first()->id,
            'paid' => true,
            'course_date' => "2023-07-01",
            "duration" => "01:00",
            'learned_notions' => "Example notions text",
            'hourly_rate' => 50,
        ];
    }
}

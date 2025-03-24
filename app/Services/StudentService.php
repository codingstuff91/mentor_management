<?php

namespace App\Services;

use App\Models\Student;
use Carbon\Carbon;

class StudentService
{
    public static function count_total_hours(Student $student): string
    {
        $total = Carbon::parse('00:00');

        $courses = $student->courses;

        foreach ($courses as $course) {
            $total->addHours(Carbon::parse($course->duration)->hour);
            $total->addMinutes(Carbon::parse($course->duration)->minute);
        }

        return $total->format('H:i');
    }
}

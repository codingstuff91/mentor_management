<?php

namespace App\Services;

use App\Models\Course;
use Carbon\Carbon;

class CourseService
{
    public static function calculate_total_price(string $duration, int $hourlyRate): float
    {
        $durationInHours = self::tranform_course_duration_in_minutes_into_HH_MM_format($duration);

        $hoursCount = Carbon::parse($durationInHours)->hour + (Carbon::parse($durationInHours)->minute / 60);

        return $hoursCount * $hourlyRate;
    }

    public static function transform_duration_in_minutes(string $courseDuration): float
    {
        [$hours, $minutes, $seconds] = explode(":", $courseDuration);

        return ($hours * 60 + $minutes);
    }

    public static function tranform_course_duration_in_minutes_into_HH_MM_format(string $courseDuration): string
    {
        $hours = floor($courseDuration / 60);
        $remainingMinutes = $courseDuration % 60;

        return sprintf('%02d:%02d', $hours, $remainingMinutes);
    }
}

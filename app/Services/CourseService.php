<?php

namespace App\Services;

use App\Models\Course;
use Carbon\Carbon;

class CourseService
{
    public static function calculate_total_price(string $duration, int $hourlyRate): float
    {
        $durationInHours = self::tranform_duration_into_HH_MM_format($duration);

        $hoursCount = Carbon::parse($durationInHours)->hour + (Carbon::parse($durationInHours)->minute / 60);

        return $hoursCount * $hourlyRate;
    }

    public static function transform_duration_in_minutes(string $courseDuration): float
    {
        [$hours, $minutes] = explode(":", $courseDuration);

        return ($hours * 60 + $minutes);
    }

    public static function tranform_duration_into_HH_MM_format(string $courseDurationInMinutes): string
    {
        $hours = floor($courseDurationInMinutes / 60);
        $remainingMinutes = $courseDurationInMinutes % 60;

        return sprintf('%02d:%02d', $hours, $remainingMinutes);
    }
}

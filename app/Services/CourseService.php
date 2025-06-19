<?php

namespace App\Services;

use App\Models\Course;
use Carbon\Carbon;

class CourseService
{
    public static function calculate_total_price(string $duration, int $hourlyRate): int
    {
        $durationInHours = self::tranform_duration_into_HH_MM_format($duration);

        $hoursCount = Carbon::parse($durationInHours)->hour + (Carbon::parse($durationInHours)->minute / 60);

        return (int) $hoursCount * $hourlyRate;
    }

    public static function transform_duration_in_minutes(string $courseDuration): int
    {
        [$hours, $minutes] = explode(":", $courseDuration);

        return (int) ($hours * 60 + $minutes);
    }

    public static function tranform_duration_into_HH_MM_format(int $courseDurationInMinutes): string
    {
        $hours = floor($courseDurationInMinutes / 60);
        $remainingMinutes = $courseDurationInMinutes % 60;

        return sprintf('%02d:%02d', $hours, $remainingMinutes);
    }
}

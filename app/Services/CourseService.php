<?php

namespace App\Services;

use Carbon\Carbon;

class CourseService
{
    public static function calculate_total_price(string $duration, int $hourlyRate): float
    {
        $hoursCount = Carbon::parse($duration)->hour + (Carbon::parse($duration)->minute / 60);

        return $hoursCount * $hourlyRate;
    }
}

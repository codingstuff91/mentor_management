<?php

use App\Services\CourseService;

it('calculates the total price of a course based on duration and hourly rate', function ($duration, $expectedTotalPrice) {
    $hourlyRate = 10;

    $courseTotalPrice = CourseService::calculate_total_price($duration, $hourlyRate);

    expect($courseTotalPrice)->toBe($expectedTotalPrice);
})->with([
    'One hour' => ["01:00", 10.0],
    'Two hours' => ["02:00", 20.0],
    'Two hours and 30 minutes' => ["02:30",25.0],
]);
